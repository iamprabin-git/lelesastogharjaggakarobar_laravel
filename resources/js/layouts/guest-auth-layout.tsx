import { Head, Link, usePage } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

type Company = { name?: string | null; logo?: string | null } | null;

export function GuestAuthLayout({
    children,
    title,
    description,
}: PropsWithChildren<{
    title: string;
    description?: string;
}>) {
    const { company } = usePage<{ company: Company }>().props;

    return (
        <>
            <Head title={title} />
            <div className="flex min-h-screen flex-col items-center justify-center bg-muted/40 p-4">
                <div className="w-full max-w-md">
                    <Card className="shadow-lg">
                        <CardHeader className="space-y-1 text-center">
                            <Link href="/" className="mx-auto mb-2 block">
                                {company?.logo ? (
                                    <img src={company.logo} alt="" className="mx-auto size-12 rounded-full border object-cover" />
                                ) : (
                                    <span className="text-xl font-bold tracking-tight">{company?.name ?? 'Home'}</span>
                                )}
                            </Link>
                            <CardTitle className="text-2xl">{title}</CardTitle>
                            {description ? <CardDescription>{description}</CardDescription> : null}
                        </CardHeader>
                        <CardContent>{children}</CardContent>
                    </Card>
                    <p className="text-muted-foreground mt-6 text-center text-sm">
                        <Link href="/privacy-policy" className="text-primary hover:underline">
                            Privacy
                        </Link>
                        {' · '}
                        <Link href="/terms" className="text-primary hover:underline">
                            Terms
                        </Link>
                    </p>
                </div>
            </div>
        </>
    );
}
