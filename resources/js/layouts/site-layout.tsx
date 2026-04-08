import { Head, usePage } from '@inertiajs/react';
import type { PropsWithChildren, ReactNode } from 'react';
import { SiteFooter } from '@/components/site-footer';
import { SiteHeader } from '@/components/site-header';

type Flash = { success?: string | null; error?: string | null };

export function SiteLayout({
    children,
    title,
}: PropsWithChildren<{
    title?: string;
}>) {
    const { flash } = usePage<{ flash: Flash }>().props;
    const pageTitle = title ? `${title} | Lele Sasto Ghar` : 'Lele Sasto Ghar Jagga Karobar Kendra';

    return (
        <>
            <Head title={pageTitle} />
            <div className="flex min-h-screen flex-col">
                <SiteHeader />
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
                <SiteFooter />
            </div>
        </>
    );
}
