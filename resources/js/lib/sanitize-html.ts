import DOMPurify from 'dompurify';

/**
 * Sanitize CMS/admin-authored HTML before injecting with dangerouslySetInnerHTML.
 * Matches the profile used on the property detail description.
 */
export function sanitizeRichHtml(html: string | null | undefined): string {
    if (html == null || typeof html !== 'string') {
        return '';
    }
    const trimmed = html.trim();
    if (!trimmed) {
        return '';
    }

    return DOMPurify.sanitize(trimmed, {
        USE_PROFILES: { html: true },
    });
}
