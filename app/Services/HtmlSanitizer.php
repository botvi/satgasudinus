<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;

/** Whitelist sederhana untuk HTML dari editor Quill; cukup untuk heading, teks tebal, list, kutipan, tautan. */
class HtmlSanitizer
{
    private const ALLOWED = ['p', 'br', 'strong', 'b', 'em', 'i', 'u', 'h2', 'h3', 'ul', 'ol', 'li', 'blockquote', 'a'];

    public static function clean(?string $html): string
    {
        if (! $html || trim(strip_tags($html)) === '') {
            return '';
        }

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8"?><div id="r">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $root = $doc->getElementById('r');
        self::walk($root);

        $out = '';
        foreach ($root->childNodes as $n) {
            $out .= $doc->saveHTML($n);
        }

        return trim($out);
    }

    private static function walk(DOMNode $node): void
    {
        foreach (iterator_to_array($node->childNodes) as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }
            self::walk($child);
            $tag = strtolower($child->tagName);

            if (! in_array($tag, self::ALLOWED, true)) {
                if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed'], true)) {
                    $node->removeChild($child);
                    continue;
                }
                while ($child->firstChild) {
                    $node->insertBefore($child->firstChild, $child);
                }
                $node->removeChild($child);
                continue;
            }

            $href = trim($child->getAttribute('href'));
            foreach (iterator_to_array($child->attributes) as $a) {
                $child->removeAttribute($a->name);
            }
            if ($tag === 'a') {
                if (preg_match('~^(https?://|mailto:|tel:|/)~i', $href)) {
                    $child->setAttribute('href', $href);
                    $child->setAttribute('target', '_blank');
                    $child->setAttribute('rel', 'noopener noreferrer');
                }
            }
        }
    }
}
