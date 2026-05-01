import type { ReactNode } from 'react';
import { cn } from '@/lib/utils';

const statTones = {
    blue: 'bg-linear-to-r from-[#4f8cff] to-[#3d7aed]',
    slate: 'bg-linear-to-r from-zinc-600 to-zinc-800',
    amber: 'bg-linear-to-r from-[#f59e0b] to-[#ea580c]',
    violet: 'bg-linear-to-r from-[#7c6fd6] to-[#5348c7]',
} as const;

export type PanelStatTone = keyof typeof statTones;

export function PanelStatCard({
    title,
    value,
    tone = 'blue',
    className,
}: {
    title: string;
    value: ReactNode;
    tone?: PanelStatTone;
    className?: string;
}) {
    return (
        <div className={cn('overflow-hidden rounded-lg border border-black/[0.06] shadow-sm dark:border-white/10', className)}>
            <div className={cn('flex min-h-[52px] items-center justify-between gap-3 px-4 py-3 text-white', statTones[tone])}>
                <span className="text-[11px] font-semibold tracking-wider text-white/95 uppercase">{title}</span>
                <span className="text-2xl font-bold tabular-nums text-white">{value}</span>
            </div>
        </div>
    );
}

export function PanelWidget({
    title,
    description,
    children,
    className,
    bodyClassName,
    headerExtra,
}: {
    title?: string;
    description?: string;
    children: ReactNode;
    className?: string;
    bodyClassName?: string;
    headerExtra?: ReactNode;
}) {
    const hasHeader = title || description || headerExtra;

    return (
        <div
            className={cn(
                'overflow-hidden rounded-lg border border-zinc-200/90 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900',
                className,
            )}
        >
            {hasHeader ? (
                <div className="flex flex-wrap items-start justify-between gap-3 border-b border-zinc-100 bg-zinc-50/90 px-4 py-3 dark:border-zinc-800 dark:bg-zinc-950/40">
                    <div className="min-w-0">
                        {title ? (
                            <h3 className="text-[11px] font-bold tracking-[0.14em] text-zinc-500 uppercase dark:text-zinc-400">
                                {title}
                            </h3>
                        ) : null}
                        {description ? <p className="text-muted-foreground mt-1 text-xs">{description}</p> : null}
                    </div>
                    {headerExtra}
                </div>
            ) : null}
            <div className={cn('p-4 md:p-5', bodyClassName)}>{children}</div>
        </div>
    );
}

export function PanelPageHeader({
    title,
    description,
    actions,
}: {
    title: string;
    description?: string;
    actions?: ReactNode;
}) {
    return (
        <div className="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h1 className="text-2xl font-bold tracking-tight text-zinc-900 md:text-[1.65rem] dark:text-zinc-50">{title}</h1>
                {description ? <p className="text-muted-foreground mt-1 max-w-2xl text-sm">{description}</p> : null}
            </div>
            {actions ? <div className="flex shrink-0 flex-wrap items-center gap-2">{actions}</div> : null}
        </div>
    );
}

/** Pill badge styled like NOVUS status chips */
export function PanelStatusBadge({
    children,
    variant = 'neutral',
    className,
}: {
    children: ReactNode;
    variant?: 'success' | 'warning' | 'neutral' | 'primary';
    className?: string;
}) {
    const v =
        variant === 'success'
            ? 'bg-emerald-500/15 text-emerald-800 dark:text-emerald-300'
            : variant === 'warning'
              ? 'bg-amber-500/15 text-amber-900 dark:text-amber-300'
              : variant === 'primary'
                ? 'bg-[#4657d4]/15 text-[#3647b7] dark:text-indigo-300'
                : 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-300';

    return (
        <span className={cn('inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold', v, className)}>
            {children}
        </span>
    );
}
