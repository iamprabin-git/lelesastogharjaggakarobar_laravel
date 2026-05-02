import type { ReactNode } from 'react';
import { Flower2, Leaf, Sparkles } from 'lucide-react';
import { cn } from '@/lib/utils';

/** Soft blooms, leaves, and light washes behind the spotlight hero. */
export function CelebrationBackdrop({ className }: { className?: string }) {
    return (
        <div className={cn('pointer-events-none absolute inset-0 overflow-hidden', className)} aria-hidden>
            <div className="absolute -left-28 top-20 h-[28rem] w-[28rem] rounded-full bg-gradient-to-br from-orange-400/18 via-rose-400/12 to-transparent blur-3xl dark:from-orange-500/14 dark:via-rose-500/10" />
            <div className="absolute -right-24 top-40 h-[22rem] w-[22rem] rounded-full bg-gradient-to-bl from-amber-400/16 via-orange-300/10 to-transparent blur-3xl dark:from-amber-500/12" />
            <div className="absolute bottom-16 left-1/4 h-72 w-72 -translate-x-1/2 rounded-full bg-primary/12 blur-3xl dark:bg-primary/10" />
            <div className="absolute bottom-32 right-1/4 h-56 w-56 rounded-full bg-rose-400/10 blur-3xl dark:bg-rose-500/8" />

            <Flower2
                strokeWidth={1}
                className="absolute left-0 top-16 size-[5.25rem] -rotate-[16deg] text-orange-400/28 dark:left-4 dark:text-orange-400/18 sm:size-[7rem] md:size-[10rem]"
            />
            <Flower2
                strokeWidth={1}
                className="absolute right-0 top-28 size-[4.75rem] rotate-[20deg] scale-x-[-1] text-rose-400/22 dark:right-4 dark:text-rose-400/14 sm:size-[6.5rem] md:size-[9rem]"
            />
            <Flower2
                strokeWidth={1}
                className="absolute bottom-28 left-[-1rem] size-[5.5rem] rotate-[148deg] text-amber-500/22 dark:bottom-36 dark:left-6 dark:text-amber-400/14 sm:size-[7.5rem] md:size-[11rem]"
            />
            <Flower2
                strokeWidth={1}
                className="absolute bottom-36 right-[-1.25rem] size-[5rem] -rotate-[8deg] scale-x-[-1] text-orange-400/26 dark:bottom-44 dark:right-4 dark:text-orange-400/16 sm:size-[6.5rem] md:size-[9.5rem]"
            />

            <Leaf className="absolute left-[10%] top-[44%] size-[3.25rem] -rotate-[38deg] text-emerald-600/18 dark:text-emerald-400/14 md:size-14" />
            <Leaf className="absolute right-[11%] top-[36%] size-12 rotate-[128deg] scale-x-[-1] text-emerald-600/14 dark:text-emerald-400/12 md:size-[3.25rem]" />
            <Leaf className="absolute bottom-[26%] right-[18%] size-14 rotate-[52deg] text-emerald-600/16 dark:text-emerald-400/12 md:size-16" />

            <Sparkles className="absolute left-[22%] top-[28%] size-5 text-amber-500/35 animate-pulse dark:text-amber-400/25" />
            <Sparkles className="absolute right-[26%] top-[22%] size-4 text-orange-400/40 animate-pulse delay-150 dark:text-orange-400/28" />
            <Sparkles className="absolute bottom-[40%] left-[18%] hidden size-4 text-rose-400/35 animate-pulse delay-300 dark:text-rose-400/22 sm:block" />
            <Sparkles className="absolute bottom-[22%] right-[30%] hidden size-5 text-amber-500/30 animate-pulse delay-700 dark:text-amber-400/22 sm:block" />
        </div>
    );
}

/** Folded congratulations ribbon + page title + optional period pill. */
export function CongratsRibbonHeading({
    ribbonLabel = 'Congratulations',
    title,
    periodLabel,
}: {
    ribbonLabel?: string;
    title: string;
    periodLabel?: string | null;
}) {
    return (
        <div className="relative z-10 mx-auto mb-4 flex max-w-3xl flex-col items-center px-3 pt-2 sm:px-4">
            <div className="flex w-full justify-center overflow-hidden px-0.5">
                <div className="origin-top scale-[0.82] transform-gpu drop-shadow-[0_8px_24px_rgba(234,88,12,0.35)] dark:drop-shadow-[0_10px_28px_rgba(0,0,0,0.45)] max-[380px]:scale-[0.74] sm:scale-100">
                    <div className="relative flex items-stretch justify-center">
                        {/* Left ribbon tail */}
                        <div className="flex shrink-0 flex-col justify-center">
                            <div className="h-0 w-0 border-y-[calc(1rem+5px)] border-r-[1.625rem] border-y-transparent border-r-orange-800 dark:border-r-orange-950 md:border-y-[1.125rem] md:border-r-[2rem]" />
                        </div>

                        {/* Center band */}
                        <div className="relative flex items-center bg-gradient-to-b from-orange-500 via-orange-600 to-orange-800 px-5 py-2.5 shadow-[inset_0_2px_0_rgba(255,255,255,0.28)] dark:from-orange-600 dark:via-orange-700 dark:to-orange-950 sm:px-7 sm:py-3 md:px-12 md:py-4">
                            <div className="absolute inset-x-5 top-1 h-px bg-white/40 sm:inset-x-6 md:inset-x-10" />
                            <Leaf className="absolute bottom-1 left-4 size-6 -rotate-[65deg] text-white/20 sm:left-5 sm:size-7 md:left-8 md:size-8" />
                            <Leaf className="absolute bottom-1 right-4 size-6 rotate-[65deg] scale-x-[-1] text-white/20 sm:right-5 sm:size-7 md:right-8 md:size-8" />
                            <span className="relative max-w-[min(100vw-6rem,20rem)] text-center font-serif text-[11px] font-bold uppercase tracking-[0.22em] text-white drop-shadow-sm sm:max-w-none sm:text-sm sm:tracking-[0.32em] md:text-base md:tracking-[0.38em]">
                                {ribbonLabel}
                            </span>
                        </div>

                        {/* Right ribbon tail */}
                        <div className="flex shrink-0 flex-col justify-center">
                            <div className="h-0 w-0 border-y-[calc(1rem+5px)] border-l-[1.625rem] border-y-transparent border-l-orange-950 dark:border-l-black/40 md:border-y-[1.125rem] md:border-l-[2rem]" />
                        </div>
                    </div>
                </div>
            </div>

            <div className="mt-2 flex items-center gap-3 opacity-90">
                <div className="h-px w-12 bg-gradient-to-r from-transparent via-orange-500 to-orange-600/60 md:w-16 dark:via-orange-400" />
                <Flower2 className="size-5 text-orange-500/70 dark:text-orange-400/55" strokeWidth={1.5} />
                <Sparkles className="size-4 text-amber-500 dark:text-amber-400/90" />
                <Flower2 className="size-5 scale-x-[-1] text-rose-500/65 dark:text-rose-400/50" strokeWidth={1.5} />
                <div className="h-px w-12 bg-gradient-to-l from-transparent via-orange-500 to-orange-600/60 md:w-16 dark:via-orange-400" />
            </div>

            <h1 className="mt-6 break-words text-center text-2xl font-bold tracking-tight text-foreground sm:text-3xl md:mt-8 md:text-4xl lg:text-[2.65rem] lg:leading-[1.12]">
                {title}
            </h1>
            {periodLabel ? (
                <p className="text-primary mt-5 rounded-full border border-primary/30 bg-primary/10 px-6 py-2 text-xs font-semibold uppercase tracking-[0.26em] shadow-sm dark:bg-primary/18">
                    {periodLabel}
                </p>
            ) : null}
        </div>
    );
}

/** Wraps the main honor card with corner blossoms and a subtle festive frame. */
export function SpotlightHonorFrame({ children, className }: { children: ReactNode; className?: string }) {
    return (
        <div className={cn('relative mx-auto max-w-5xl px-1', className)}>
            <div className="pointer-events-none absolute -left-1 -top-2 md:left-2 md:top-0" aria-hidden>
                <Flower2 strokeWidth={1.15} className="size-16 rotate-[-22deg] text-orange-500/40 dark:text-orange-400/28 md:size-[4.25rem]" />
            </div>
            <div className="pointer-events-none absolute -right-2 top-8 md:right-2" aria-hidden>
                <Flower2 strokeWidth={1.15} className="size-14 rotate-[18deg] scale-x-[-1] text-rose-500/35 dark:text-rose-400/24 md:size-[4rem]" />
            </div>
            <div className="pointer-events-none absolute bottom-24 left-[-0.35rem] md:bottom-28 md:left-2" aria-hidden>
                <Flower2 strokeWidth={1.15} className="size-[4.5rem] rotate-[158deg] text-amber-600/35 dark:text-amber-500/22" />
            </div>
            <div className="pointer-events-none absolute bottom-16 right-0 md:bottom-20 md:right-3" aria-hidden>
                <Flower2 strokeWidth={1.15} className="size-16 -rotate-[12deg] scale-x-[-1] text-orange-500/38 dark:text-orange-400/26" />
            </div>

            <div className="relative rounded-[1.35rem] bg-gradient-to-br from-orange-300/45 via-orange-200/20 to-rose-300/35 p-[2px] shadow-xl ring-1 ring-orange-200/40 dark:from-orange-500/25 dark:via-orange-600/10 dark:to-rose-500/20 dark:ring-orange-900/40 md:p-[3px]">
                <div className="overflow-hidden rounded-[1.2rem]">{children}</div>
            </div>
        </div>
    );
}

/** Inner message panel with a pinned mini-ribbon. */
export function CelebrationMessagePanel({ children }: { children: ReactNode }) {
    return (
        <div className="border-border/60 relative mt-10 rounded-2xl border bg-gradient-to-b from-card via-card to-orange-50/[0.08] p-5 pt-8 shadow-inner dark:to-orange-950/15 sm:p-6 sm:pt-9 md:p-8 md:pt-10">
            <div className="absolute -top-4 left-1/2 flex -translate-x-1/2 items-center drop-shadow-md">
                <div className="flex items-center rounded-md bg-gradient-to-r from-amber-600 via-orange-600 to-orange-700 px-4 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-white ring-2 ring-background dark:from-amber-700 dark:via-orange-700 dark:to-orange-900 md:px-5 md:text-[11px] md:tracking-[0.26em]">
                    <Sparkles className="mr-2 size-3.5 opacity-95" aria-hidden />
                    With appreciation
                </div>
            </div>
            {children}
        </div>
    );
}
