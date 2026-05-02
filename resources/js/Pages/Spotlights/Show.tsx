import { Link } from '@inertiajs/react';
import { Award, Flower2, Sparkles } from 'lucide-react';
import {
    CelebrationBackdrop,
    CelebrationMessagePanel,
    CongratsRibbonHeading,
    SpotlightHonorFrame,
} from '@/components/spotlight-celebration';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { SiteLayout } from '@/layouts/site-layout';
import { sanitizeRichHtml } from '@/lib/sanitize-html';

export type MonthlySpotlightPayload = {
    kind: string;
    honoree_name: string;
    subtitle: string | null;
    period_label: string | null;
    page_title: string | null;
    image: string | null;
    congratulations_html: string | null;
    is_published: boolean;
};

export default function SpotlightShow({
    variant,
    spotlight,
}: {
    variant: 'agent' | 'buyer';
    spotlight: MonthlySpotlightPayload | null;
}) {
    const defaultHeading = variant === 'agent' ? 'Agent of the month' : 'Buyer of the month';
    const metaTitle = spotlight?.page_title?.trim() || defaultHeading;
    const congratulationsSafe =
        spotlight?.congratulations_html != null ? sanitizeRichHtml(spotlight.congratulations_html) : '';

    return (
        <SiteLayout title={metaTitle}>
            <div className="from-muted/50 relative isolate overflow-hidden bg-gradient-to-b via-orange-50/[0.15] to-background dark:via-orange-950/10">
                <CelebrationBackdrop />
                <div
                    className="pointer-events-none absolute inset-x-0 top-0 h-[380px] bg-[radial-gradient(ellipse_75%_55%_at_50%_-15%,hsl(var(--primary)/0.18),transparent_62%)] dark:opacity-90"
                    aria-hidden
                />

                <div className="relative container mx-auto max-w-5xl px-4 py-14 md:py-20">
                    <div className="mb-8 flex flex-col gap-3 sm:mb-10 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">
                        <Button variant="ghost" size="sm" className="-ml-2 w-fit gap-2 text-muted-foreground" asChild>
                            <Link href="/">
                                <span aria-hidden>←</span> Back home
                            </Link>
                        </Button>
                        <div className="text-primary inline-flex w-fit items-center gap-2 rounded-full border border-primary/30 bg-gradient-to-r from-primary/12 via-primary/8 to-orange-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] shadow-sm dark:from-primary/20 dark:to-orange-500/10">
                            <Flower2 className="size-3.5 opacity-90" aria-hidden />
                            Spotlight
                        </div>
                    </div>

                    {spotlight === null ? (
                        <Card className="border-border/80 shadow-lg">
                            <CardContent className="p-10 text-center">
                                <p className="text-muted-foreground text-lg">This spotlight has not been set up yet.</p>
                                <p className="text-muted-foreground mt-2 text-sm">Please check back soon.</p>
                            </CardContent>
                        </Card>
                    ) : !spotlight.is_published ? (
                        <Card className="relative overflow-hidden border-amber-500/35 bg-gradient-to-b from-amber-500/[0.07] to-card shadow-lg">
                            <Flower2
                                strokeWidth={1}
                                className="pointer-events-none absolute -right-6 -top-6 size-28 text-amber-600/15 dark:text-amber-400/12"
                                aria-hidden
                            />
                            <Flower2
                                strokeWidth={1}
                                className="pointer-events-none absolute -bottom-8 -left-6 size-24 rotate-[165deg] text-orange-500/12 dark:text-orange-400/10"
                                aria-hidden
                            />
                            <CardContent className="relative space-y-3 p-6 text-center md:p-10">
                                <Sparkles className="text-amber-600 mx-auto size-10 dark:text-amber-400" aria-hidden />
                                <h1 className="text-2xl font-bold tracking-tight">{metaTitle}</h1>
                                <p className="text-muted-foreground">
                                    This page is being prepared. Check back once it is published from the admin panel.
                                </p>
                            </CardContent>
                        </Card>
                    ) : (
                        <div className="relative space-y-8 md:space-y-12">
                            <CongratsRibbonHeading title={metaTitle} periodLabel={spotlight.period_label} />

                            <SpotlightHonorFrame>
                                <Card className="overflow-hidden border-orange-200/40 shadow-2xl ring-1 ring-black/[0.04] dark:border-orange-900/35 dark:ring-white/[0.06]">
                                    <CardContent className="grid gap-0 p-0 md:grid-cols-[1fr_1.15fr]">
                                        <div className="relative min-h-[280px] bg-muted/50 md:min-h-[380px]">
                                            {spotlight.image ? (
                                                <img
                                                    src={spotlight.image}
                                                    alt={spotlight.honoree_name}
                                                    className="absolute inset-0 h-full w-full object-cover"
                                                />
                                            ) : (
                                                <div className="from-primary/25 text-primary absolute inset-0 flex items-center justify-center bg-gradient-to-br via-orange-50/50 to-muted dark:via-orange-950/20">
                                                    <div className="relative">
                                                        <Flower2
                                                            strokeWidth={1}
                                                            className="size-28 opacity-35 md:size-32"
                                                            aria-hidden
                                                        />
                                                        <Award className="absolute inset-0 m-auto size-14 opacity-50 md:size-16" aria-hidden />
                                                    </div>
                                                </div>
                                            )}
                                            <div className="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent md:bg-gradient-to-r md:from-transparent md:via-black/5 md:to-background/98" />

                                            {/* Ribbon badge on photo */}
                                            <div
                                                className="pointer-events-none absolute bottom-5 left-5 rotate-[-4deg] md:bottom-8 md:left-8"
                                                aria-hidden
                                            >
                                                <div className="relative bg-gradient-to-r from-orange-600 via-orange-500 to-rose-600 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-white shadow-[0_10px_28px_rgba(234,88,12,0.45)] ring-2 ring-white/45 dark:ring-white/20">
                                                    Honoree
                                                    <span className="absolute -bottom-1 left-3 h-2 w-8 skew-x-[24deg] bg-orange-900/50 dark:bg-black/35" />
                                                </div>
                                            </div>
                                        </div>

                                        <div className="relative flex flex-col justify-center bg-gradient-to-br from-card via-card to-orange-50/[0.35] p-6 dark:to-orange-950/20 md:p-10 lg:p-12">
                                            <div className="mb-2 inline-flex items-center gap-2 text-orange-600 dark:text-orange-400">
                                                <Sparkles className="size-4 shrink-0" aria-hidden />
                                                <span className="text-xs font-bold uppercase tracking-[0.28em]">Celebrating</span>
                                            </div>
                                            <h2 className="break-words text-3xl font-bold tracking-tight text-foreground md:text-4xl lg:text-[2.35rem] lg:leading-tight">
                                                {spotlight.honoree_name}
                                            </h2>
                                            {spotlight.subtitle ? (
                                                <p className="text-muted-foreground mt-4 text-lg font-medium leading-snug">{spotlight.subtitle}</p>
                                            ) : null}

                                            <CelebrationMessagePanel>
                                                <div className="text-primary mb-4 flex items-center gap-2 text-sm font-semibold">
                                                    <Flower2 className="size-4 shrink-0 opacity-90" aria-hidden />
                                                    Congratulations message
                                                </div>
                                                {congratulationsSafe ? (
                                                    <div
                                                        className="text-muted-foreground [&_a]:text-primary space-y-3 text-[15px] leading-relaxed [&_a]:underline [&_blockquote]:border-primary/30 [&_blockquote]:border-l-4 [&_blockquote]:pl-4 [&_blockquote]:italic [&_h2]:text-foreground [&_h2]:text-lg [&_h2]:font-semibold [&_h3]:text-foreground [&_h3]:font-semibold [&_p]:leading-relaxed [&_img]:max-w-full"
                                                        dangerouslySetInnerHTML={{ __html: congratulationsSafe }}
                                                    />
                                                ) : (
                                                    <p className="text-muted-foreground text-sm italic">
                                                        A congratulations message will appear here once added in the admin panel.
                                                    </p>
                                                )}
                                            </CelebrationMessagePanel>
                                        </div>
                                    </CardContent>
                                </Card>
                            </SpotlightHonorFrame>

                            <div className="relative mx-auto flex w-full max-w-md flex-col gap-3 pt-2 sm:max-w-none sm:flex-row sm:flex-wrap sm:justify-center">
                                <Button asChild size="lg" className="w-full sm:w-auto">
                                    <Link href={variant === 'agent' ? '/agents' : '/properties'}>
                                        {variant === 'agent' ? 'Meet our agents' : 'Browse properties'}
                                    </Link>
                                </Button>
                                <Button asChild variant="outline" size="lg" className="w-full sm:w-auto">
                                    <Link href="/contact">Contact us</Link>
                                </Button>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </SiteLayout>
    );
}
