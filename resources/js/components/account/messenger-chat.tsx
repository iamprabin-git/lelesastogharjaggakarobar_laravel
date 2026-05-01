import { Link } from '@inertiajs/react';
import type { ReactNode } from 'react';
import { cn } from '@/lib/utils';

/** Messenger-style avatar for staff/support threads */
export function MessengerPeerAvatar({
    title,
    className,
    size = 'md',
}: {
    title: string;
    className?: string;
    size?: 'sm' | 'md' | 'lg';
}) {
    const letter = title.trim().slice(0, 1).toUpperCase() || '?';
    const sz = size === 'lg' ? 'size-14 text-xl' : size === 'sm' ? 'size-11 text-sm' : 'size-12 text-lg';

    return (
        <div
            className={cn(
                'flex shrink-0 items-center justify-center rounded-full bg-linear-to-br from-[#0084ff] to-[#006edb] font-semibold text-white shadow-inner',
                sz,
                className,
            )}
            aria-hidden
        >
            {letter}
        </div>
    );
}

export function MessengerListRow({
    href,
    title,
    preview,
    timeLabel,
    unread,
    active,
}: {
    href: string;
    title: string;
    preview: string | null;
    timeLabel: string;
    unread: boolean;
    active?: boolean;
}) {
    return (
        <Link
            href={href}
            preserveScroll
            className={cn(
                'hover:bg-muted/80 flex gap-3 rounded-xl px-3 py-3 transition-colors sm:px-4',
                unread && 'bg-[#0084ff]/[0.06]',
                active && 'bg-muted/60 ring-primary/15 ring-1',
            )}
        >
            <MessengerPeerAvatar title={title} size="md" />
            <div className="min-w-0 flex-1">
                <div className="flex items-baseline justify-between gap-2">
                    <span className={cn('truncate font-semibold text-zinc-900 dark:text-zinc-50', unread && 'text-[#0084ff] dark:text-[#5eb3ff]')}>
                        {title}
                    </span>
                    {timeLabel ? (
                        <span className="text-muted-foreground shrink-0 text-[11px] tabular-nums">{timeLabel}</span>
                    ) : null}
                </div>
                <div className="mt-0.5 flex items-center gap-2">
                    <p className={cn('text-muted-foreground truncate text-[13px] leading-snug', unread && 'font-medium text-zinc-700 dark:text-zinc-300')}>
                        {preview ?? 'No messages yet'}
                    </p>
                    {unread ? (
                        <span className="bg-[#0084ff] size-2 shrink-0 rounded-full" aria-label="Unread" />
                    ) : null}
                </div>
            </div>
        </Link>
    );
}

function formatBubbleClock(iso: string): string {
    const d = new Date(iso);
    if (Number.isNaN(d.getTime())) {
        return '';
    }

    return d.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' });
}

export function MessengerBubble({
    body,
    createdAt,
    isMe,
    showTail,
}: {
    body: string;
    createdAt: string;
    isMe: boolean;
    /** Rough messenger corner tweak */
    showTail?: boolean;
}) {
    const clock = formatBubbleClock(createdAt);

    return (
        <div className={cn('flex w-full', isMe ? 'justify-end' : 'justify-start')}>
            <div
                className={cn(
                    'max-w-[min(100%,24rem)] px-3.5 py-2 shadow-sm',
                    isMe
                        ? cn(
                              'rounded-[18px] bg-linear-to-b from-[#0084ff] to-[#0073e6] text-white',
                              showTail !== false ? 'rounded-br-[4px]' : 'rounded-br-[18px]',
                          )
                        : cn(
                              'border-border text-foreground rounded-[18px] border bg-white dark:bg-zinc-800',
                              showTail !== false ? 'rounded-bl-[4px]' : 'rounded-bl-[18px]',
                          ),
                )}
            >
                <p className="text-[15px] leading-snug break-words whitespace-pre-wrap">{body}</p>
                <time
                    className={cn('mt-1 block text-end text-[11px] tabular-nums', isMe ? 'text-white/75' : 'text-muted-foreground')}
                    dateTime={createdAt}
                >
                    {clock}
                </time>
            </div>
        </div>
    );
}

export function MessengerThreadChrome({
    header,
    children,
    footer,
    className,
}: {
    header: ReactNode;
    children: ReactNode;
    footer: ReactNode;
    className?: string;
}) {
    return (
        <div
            className={cn(
                'border-border bg-background flex max-h-[min(760px,calc(100dvh-9rem))] min-h-[min(520px,calc(100dvh-9rem))] flex-col overflow-hidden rounded-2xl border shadow-md sm:max-h-[min(820px,calc(100dvh-8rem))] sm:min-h-[560px]',
                className,
            )}
        >
            {header}
            <div className="bg-[#f0f2f5] dark:bg-zinc-950/90 flex min-h-0 flex-1 flex-col overflow-hidden">
                {children}
            </div>
            {footer}
        </div>
    );
}

export function formatMessengerTime(iso: string | null): string {
    if (!iso) {
        return '';
    }
    const d = new Date(iso);
    if (Number.isNaN(d.getTime())) {
        return '';
    }
    const now = new Date();
    const sameDay =
        d.getDate() === now.getDate() &&
        d.getMonth() === now.getMonth() &&
        d.getFullYear() === now.getFullYear();
    const yesterday = new Date(now);
    yesterday.setDate(now.getDate() - 1);
    const isYesterday =
        d.getDate() === yesterday.getDate() &&
        d.getMonth() === yesterday.getMonth() &&
        d.getFullYear() === yesterday.getFullYear();

    if (sameDay) {
        return d.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' });
    }
    if (isYesterday) {
        return 'Yesterday';
    }
    if (now.getTime() - d.getTime() < 7 * 86400000) {
        return d.toLocaleDateString(undefined, { weekday: 'short' });
    }

    return d.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
}
