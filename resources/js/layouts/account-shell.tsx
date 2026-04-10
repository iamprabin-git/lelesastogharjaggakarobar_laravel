import { Link, router, usePage } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';

export function AccountShell({ children }: PropsWithChildren) {
    const { url } = usePage();
    const path = url.split('?')[0] ?? '';

    const tabs: { href: string; label: string; match: (p: string) => boolean }[] = [
        { href: '/account', label: 'Home', match: (p) => p === '/account' },
        {
            href: '/account/messages',
            label: 'Messages',
            match: (p) => p.startsWith('/account/messages'),
        },
        { href: '/account/profile', label: 'Profile', match: (p) => p.startsWith('/account/profile') },
    ];

    return (
        <>
            <div className="border-border bg-muted/50 border-b dark:bg-muted/20">
                <div className="container mx-auto flex flex-wrap items-center gap-2 px-4 py-2">
                    {tabs.map((t) => (
                        <Link
                            key={t.href}
                            href={t.href}
                            className={cn(
                                'rounded-lg px-4 py-2 text-sm font-medium transition-colors',
                                t.match(path)
                                    ? 'bg-background text-foreground shadow-sm ring-1 ring-border'
                                    : 'text-muted-foreground hover:bg-background/60 hover:text-foreground',
                            )}
                        >
                            {t.label}
                        </Link>
                    ))}
                    <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        className="text-muted-foreground ml-auto"
                        onClick={() => router.post('/logout')}
                    >
                        Log out
                    </Button>
                </div>
            </div>
            {children}
        </>
    );
}
