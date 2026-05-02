import { Head, usePage } from '@inertiajs/react';
import type { PropsWithChildren, ReactNode } from 'react';
import { SiteFooter } from '@/components/site-footer';
import { SiteHeader } from '@/components/site-header';
import { WhatsAppFloat } from '@/components/whatsapp-float';

type Flash = { success?: string | null; error?: string | null; status?: string | null };

export function SiteLayout({
    children,
    title,
}: PropsWithChildren<{
    title?: string;
}>) {
    const page = usePage<{ flash: Flash; auth: { user: { id: number } | null } }>();
    const { flash } = page.props;
    const path = page.url.split('?')[0] ?? '';
    const accountPanelOnly = Boolean(page.props.auth?.user && path.startsWith('/account'));

    const pageTitle = title ? `${title} | Lele Sasto Ghar` : 'Lele Sasto Ghar Jagga Karobar Kendra';

    return (
        <>
            <Head title={pageTitle} />
            <div className="flex min-h-screen flex-col overflow-x-hidden">
                {!accountPanelOnly ? <SiteHeader /> : null}
                <main className="flex-1">
                    {flash?.success && (
                        <div className="container mx-auto px-4 pt-4">
                            <div
                                className="rounded-lg border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-800 dark:text-emerald-100"
                                role="status"
                            >
                                {flash.success}
                            </div>
                        </div>
                    )}
                    {flash?.error && (
                        <div className="container mx-auto px-4 pt-4">
                            <div
                                className="rounded-lg border border-destructive/30 bg-destructive/10 px-4 py-3 text-sm text-destructive"
                                role="alert"
                            >
                                {flash.error}
                            </div>
                        </div>
                    )}
                    {children}
                </main>
                {!accountPanelOnly ? <SiteFooter /> : null}
                {!accountPanelOnly ? <WhatsAppFloat /> : null}
            </div>
        </>
    );
}
