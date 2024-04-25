<?php
 class SimplePie_Sanitize { var $base; var $remove_div = true; var $image_handler = ''; var $strip_htmltags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style'); var $encode_instead_of_strip = false; var $strip_attributes = array('bgsound', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc'); var $add_attributes = array('audio' => array('preload' => 'none'), 'iframe' => array('sandbox' => 'allow-scripts allow-same-origin'), 'video' => array('preload' => 'none')); var $strip_comments = false; var $output_encoding = 'UTF-8'; var $enable_cache = true; var $cache_location = './cache'; var $cache_name_function = 'md5'; var $timeout = 10; var $useragent = ''; var $force_fsockopen = false; var $replace_url_attributes = null; var $registry; var $https_domains = array(); public function __construct() { $this->set_url_replacements(null); } public function remove_div($enable = true) { $this->remove_div = (bool) $enable; } public function set_image_handler($page = false) { if ($page) { $this->image_handler = (string) $page; } else { $this->image_handler = false; } } public function set_registry(SimplePie_Registry $registry) { $this->registry = $registry; } public function pass_cache_data($enable_cache = true, $cache_location = './cache', $cache_name_function = 'md5', $cache_class = 'SimplePie_Cache') { if (isset($enable_cache)) { $this->enable_cache = (bool) $enable_cache; } if ($cache_location) { $this->cache_location = (string) $cache_location; } if ($cache_name_function) { $this->cache_name_function = (string) $cache_name_function; } } public function pass_file_data($file_class = 'SimplePie_File', $timeout = 10, $useragent = '', $force_fsockopen = false) { if ($timeout) { $this->timeout = (string) $timeout; } if ($useragent) { $this->useragent = (string) $useragent; } if ($force_fsockopen) { $this->force_fsockopen = (string) $force_fsockopen; } } public function strip_htmltags($tags = array('base', 'blink', 'body', 'doctype', 'embed', 'font', 'form', 'frame', 'frameset', 'html', 'iframe', 'input', 'marquee', 'meta', 'noscript', 'object', 'param', 'script', 'style')) { if ($tags) { if (is_array($tags)) { $this->strip_htmltags = $tags; } else { $this->strip_htmltags = explode(',', $tags); } } else { $this->strip_htmltags = false; } } public function encode_instead_of_strip($encode = false) { $this->encode_instead_of_strip = (bool) $encode; } public function strip_attributes($attribs = array('bgsound', 'expr', 'id', 'style', 'onclick', 'onerror', 'onfinish', 'onmouseover', 'onmouseout', 'onfocus', 'onblur', 'lowsrc', 'dynsrc')) { if ($attribs) { if (is_array($attribs)) { $this->strip_attributes = $attribs; } else { $this->strip_attributes = explode(',', $attribs); } } else { $this->strip_attributes = false; } } public function add_attributes($attribs = array('audio' => array('preload' => 'none'), 'iframe' => array('sandbox' => 'allow-scripts allow-same-origin'), 'video' => array('preload' => 'none'))) { if ($attribs) { if (is_array($attribs)) { $this->add_attributes = $attribs; } else { $this->add_attributes = explode(',', $attribs); } } else { $this->add_attributes = false; } } public function strip_comments($strip = false) { $this->strip_comments = (bool) $strip; } public function set_output_encoding($encoding = 'UTF-8') { $this->output_encoding = (string) $encoding; } public function set_url_replacements($element_attribute = null) { if ($element_attribute === null) { $element_attribute = array( 'a' => 'href', 'area' => 'href', 'blockquote' => 'cite', 'del' => 'cite', 'form' => 'action', 'img' => array( 'longdesc', 'src' ), 'input' => 'src', 'ins' => 'cite', 'q' => 'cite' ); } $this->replace_url_attributes = (array) $element_attribute; } public function set_https_domains($domains) { $this->https_domains = array(); foreach ($domains as $domain) { $domain = trim($domain, ". \t\n\r\0\x0B"); $segments = array_reverse(explode('.', $domain)); $node =& $this->https_domains; foreach ($segments as $segment) { if ($node === true) { break; } if (!isset($node[$segment])) { $node[$segment] = array(); } $node =& $node[$segment]; } $node = true; } } protected function is_https_domain($domain) { $domain = trim($domain, '. '); $segments = array_reverse(explode('.', $domain)); $node =& $this->https_domains; foreach ($segments as $segment) { if (isset($node[$segment])) { $node =& $node[$segment]; } else { break; } } return $node === true; } public function https_url($url) { return (strtolower(substr($url, 0, 7)) === 'http://') && $this->is_https_domain(parse_url($url, PHP_URL_HOST)) ? substr_replace($url, 's', 4, 0) : $url; } public function sanitize($data, $type, $base = '') { $data = trim($data); if ($data !== '' || $type & SIMPLEPIE_CONSTRUCT_IRI) { if ($type & SIMPLEPIE_CONSTRUCT_MAYBE_HTML) { if (preg_match('/(&(#(x[0-9a-fA-F]+|[0-9]+)|[a-zA-Z0-9]+)|<\/[A-Za-z][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E]*' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>)/', $data)) { $type |= SIMPLEPIE_CONSTRUCT_HTML; } else { $type |= SIMPLEPIE_CONSTRUCT_TEXT; } } if ($type & SIMPLEPIE_CONSTRUCT_BASE64) { $data = base64_decode($data); } if ($type & (SIMPLEPIE_CONSTRUCT_HTML | SIMPLEPIE_CONSTRUCT_XHTML)) { if (!class_exists('DOMDocument')) { throw new SimplePie_Exception('DOMDocument not found, unable to use sanitizer'); } $document = new DOMDocument(); $document->encoding = 'UTF-8'; $data = $this->preprocess($data, $type); set_error_handler(array('SimplePie_Misc', 'silence_errors')); $document->loadHTML($data); restore_error_handler(); $xpath = new DOMXPath($document); if ($this->strip_comments) { $comments = $xpath->query('//comment()'); foreach ($comments as $comment) { $comment->parentNode->removeChild($comment); } } if ($this->strip_htmltags) { foreach ($this->strip_htmltags as $tag) { $this->strip_tag($tag, $document, $xpath, $type); } } if ($this->strip_attributes) { foreach ($this->strip_attributes as $attrib) { $this->strip_attr($attrib, $xpath); } } if ($this->add_attributes) { foreach ($this->add_attributes as $tag => $valuePairs) { $this->add_attr($tag, $valuePairs, $document); } } $this->base = $base; foreach ($this->replace_url_attributes as $element => $attributes) { $this->replace_urls($document, $element, $attributes); } if (isset($this->image_handler) && ((string) $this->image_handler) !== '' && $this->enable_cache) { $images = $document->getElementsByTagName('img'); foreach ($images as $img) { if ($img->hasAttribute('src')) { $image_url = call_user_func($this->cache_name_function, $img->getAttribute('src')); $cache = $this->registry->call('Cache', 'get_handler', array($this->cache_location, $image_url, 'spi')); if ($cache->load()) { $img->setAttribute('src', $this->image_handler . $image_url); } else { $file = $this->registry->create('File', array($img->getAttribute('src'), $this->timeout, 5, array('X-FORWARDED-FOR' => $_SERVER['REMOTE_ADDR']), $this->useragent, $this->force_fsockopen)); $headers = $file->headers; if ($file->success && ($file->method & SIMPLEPIE_FILE_SOURCE_REMOTE === 0 || ($file->status_code === 200 || $file->status_code > 206 && $file->status_code < 300))) { if ($cache->save(array('headers' => $file->headers, 'body' => $file->body))) { $img->setAttribute('src', $this->image_handler . $image_url); } else { trigger_error("$this->cache_location is not writable. Make sure you've set the correct relative or absolute path, and that the location is server-writable.", E_USER_WARNING); } } } } } } $div = $document->getElementsByTagName('body')->item(0)->firstChild; $data = trim($document->saveHTML($div)); if ($this->remove_div) { $data = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '', $data); $data = preg_replace('/<\/div>$/', '', $data); } else { $data = preg_replace('/^<div' . SIMPLEPIE_PCRE_XML_ATTRIBUTE . '>/', '<div>', $data); } } if ($type & SIMPLEPIE_CONSTRUCT_IRI) { $absolute = $this->registry->call('Misc', 'absolutize_url', array($data, $base)); if ($absolute !== false) { $data = $absolute; } } if ($type & (SIMPLEPIE_CONSTRUCT_TEXT | SIMPLEPIE_CONSTRUCT_IRI)) { $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8'); } if ($this->output_encoding !== 'UTF-8') { $data = $this->registry->call('Misc', 'change_encoding', array($data, 'UTF-8', $this->output_encoding)); } } return $data; } protected function preprocess($html, $type) { $ret = ''; $html = preg_replace('%</?(?:html|body)[^>]*?'.'>%is', '', $html); if ($type & ~SIMPLEPIE_CONSTRUCT_XHTML) { $html = '<div>' . $html . '</div>'; $ret .= '<!DOCTYPE html>'; $content_type = 'text/html'; } else { $ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; $content_type = 'application/xhtml+xml'; } $ret .= '<html><head>'; $ret .= '<meta http-equiv="Content-Type" content="' . $content_type . '; charset=utf-8" />'; $ret .= '</head><body>' . $html . '</body></html>'; return $ret; } public function replace_urls($document, $tag, $attributes) { if (!is_array($attributes)) { $attributes = array($attributes); } if (!is_array($this->strip_htmltags) || !in_array($tag, $this->strip_htmltags)) { $elements = $document->getElementsByTagName($tag); foreach ($elements as $element) { foreach ($attributes as $attribute) { if ($element->hasAttribute($attribute)) { $value = $this->registry->call('Misc', 'absolutize_url', array($element->getAttribute($attribute), $this->base)); if ($value !== false) { $value = $this->https_url($value); $element->setAttribute($attribute, $value); } } } } } } public function do_strip_htmltags($match) { if ($this->encode_instead_of_strip) { if (isset($match[4]) && !in_array(strtolower($match[1]), array('script', 'style'))) { $match[1] = htmlspecialchars($match[1], ENT_COMPAT, 'UTF-8'); $match[2] = htmlspecialchars($match[2], ENT_COMPAT, 'UTF-8'); return "&lt;$match[1]$match[2]&gt;$match[3]&lt;/$match[1]&gt;"; } else { return htmlspecialchars($match[0], ENT_COMPAT, 'UTF-8'); } } elseif (isset($match[4]) && !in_array(strtolower($match[1]), array('script', 'style'))) { return $match[4]; } else { return ''; } } protected function strip_tag($tag, $document, $xpath, $type) { $elements = $xpath->query('body//' . $tag); if ($this->encode_instead_of_strip) { foreach ($elements as $element) { $fragment = $document->createDocumentFragment(); if (!in_array($tag, array('script', 'style'))) { $text = '<' . $tag; if ($element->hasAttributes()) { $attrs = array(); foreach ($element->attributes as $name => $attr) { $value = $attr->value; if (empty($value) && ($type & SIMPLEPIE_CONSTRUCT_XHTML)) { $value = $name; } elseif (empty($value) && ($type & SIMPLEPIE_CONSTRUCT_HTML)) { $attrs[] = $name; continue; } $attrs[] = $name . '="' . $attr->value . '"'; } $text .= ' ' . implode(' ', $attrs); } $text .= '>'; $fragment->appendChild(new DOMText($text)); } $number = $element->childNodes->length; for ($i = $number; $i > 0; $i--) { $child = $element->childNodes->item(0); $fragment->appendChild($child); } if (!in_array($tag, array('script', 'style'))) { $fragment->appendChild(new DOMText('</' . $tag . '>')); } $element->parentNode->replaceChild($fragment, $element); } return; } elseif (in_array($tag, array('script', 'style'))) { foreach ($elements as $element) { $element->parentNode->removeChild($element); } return; } else { foreach ($elements as $element) { $fragment = $document->createDocumentFragment(); $number = $element->childNodes->length; for ($i = $number; $i > 0; $i--) { $child = $element->childNodes->item(0); $fragment->appendChild($child); } $element->parentNode->replaceChild($fragment, $element); } } } protected function strip_attr($attrib, $xpath) { $elements = $xpath->query('//*[@' . $attrib . ']'); foreach ($elements as $element) { $element->removeAttribute($attrib); } } protected function add_attr($tag, $valuePairs, $document) { $elements = $document->getElementsByTagName($tag); foreach ($elements as $element) { foreach ($valuePairs as $attrib => $value) { $element->setAttribute($attrib, $value); } } } } 