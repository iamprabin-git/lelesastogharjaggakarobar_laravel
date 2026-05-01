import { Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Send } from 'lucide-react';
import { useEffect, useRef, useState } from 'react';
import {
    MessengerBubble,
    MessengerPeerAvatar,
    MessengerThreadChrome,
} from '@/components/account/messenger-chat';
import { Button } from '@/components/ui/button';
import { AccountShell } from '@/layouts/account-shell';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';

type Msg = {
    id: number;
    body: string;
    created_at: string;
    is_me: boolean;
    sender_label: string;
};

type ConvState = {
    id: number;
    subject: string;
    status: string;
    is_open: boolean;
};

export default function MessagesShow({
    conversation,
    messages: initialMessages,
}: {
    conversation: ConvState;
    messages: Msg[];
}) {
    const form = useForm({ body: '' });
    const [messages, setMessages] = useState<Msg[]>(initialMessages);
    const [conv, setConv] = useState<ConvState>(conversation);
    const endRef = useRef<HTMLDivElement>(null);

    const scrollToBottom = () => {
        endRef.current?.scrollIntoView({ behavior: 'smooth' });
    };

    useEffect(() => {
        setMessages(initialMessages);
    }, [initialMessages]);

    useEffect(() => {
        setConv(conversation);
    }, [conversation]);

    useEffect(() => {
        scrollToBottom();
    }, [messages]);

    useEffect(() => {
        const url = `/account/messages/${conv.id}/updates`;
        const timer = window.setInterval(() => {
            void fetch(url, {
                credentials: 'same-origin',
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            })
                .then((r) => (r.ok ? (r.json() as Promise<{ messages: Msg[]; conversation: ConvState }>) : null))
                .then((data) => {
                    if (!data?.messages) {
                        return;
                    }
                    setMessages(data.messages);
                    if (data.conversation) {
                        setConv(data.conversation);
                    }
                })
                .catch(() => {
                    /* ignore network errors */
                });
        }, 8000);

        return () => window.clearInterval(timer);
    }, [conv.id]);

    function send(e?: React.FormEvent) {
        e?.preventDefault();
        const text = form.data.body.trim();
        if (!text || form.processing) {
            return;
        }
        form.clearErrors();
        form.setData('body', text);
        form.post(`/account/messages/${conv.id}/messages`, {
            preserveScroll: true,
            onSuccess: () => form.reset('body'),
        });
    }

    function onComposerKeyDown(e: React.KeyboardEvent<HTMLTextAreaElement>) {
        if (e.key !== 'Enter' || e.shiftKey) {
            return;
        }
        e.preventDefault();
        send();
    }

    const peerName = conv.subject?.trim() || 'Chat';

    return (
        <SiteLayout title={peerName}>
            <AccountShell>
                <div className="mx-auto w-full max-w-lg">
                    <MessengerThreadChrome
                        className="shadow-lg"
                        header={
                            <header className="border-border bg-background flex shrink-0 items-center gap-2 border-b px-2 py-2 pr-3">
                                <Button
                                    variant="ghost"
                                    size="icon"
                                    className="size-10 shrink-0 rounded-full"
                                    aria-label="Back to chats"
                                    asChild
                                >
                                    <Link href="/account/messages">
                                        <ArrowLeft className="size-5 text-zinc-600 dark:text-zinc-300" />
                                    </Link>
                                </Button>
                                <MessengerPeerAvatar title={peerName} size="sm" />
                                <div className="min-w-0 flex-1">
                                    <h2 className="truncate font-semibold text-zinc-900 dark:text-zinc-50">{peerName}</h2>
                                    <p className="text-muted-foreground truncate text-[12px]">
                                        {conv.is_open ? (
                                            <>
                                                <span className="text-emerald-600 dark:text-emerald-400">●</span> Active ·
                                                Staff may reply anytime
                                            </>
                                        ) : (
                                            'This chat is paused — send a message to resume'
                                        )}
                                    </p>
                                </div>
                            </header>
                        }
                        footer={
                            <footer className="border-border bg-background shrink-0 border-t px-3 py-3">
                                <form onSubmit={send} className="space-y-2">
                                    <div className="flex items-end gap-2">
                                        <div className="border-border bg-muted/50 focus-within:ring-ring flex min-h-[48px] flex-1 items-end rounded-[24px] border px-4 py-2 shadow-inner focus-within:ring-2">
                                            <textarea
                                                required
                                                rows={1}
                                                value={form.data.body}
                                                onChange={(e) => form.setData('body', e.target.value)}
                                                onInput={(e) => {
                                                    const el = e.currentTarget;
                                                    el.style.height = '0';
                                                    el.style.height = `${Math.min(120, el.scrollHeight)}px`;
                                                }}
                                                onKeyDown={onComposerKeyDown}
                                                placeholder="Aa"
                                                className="placeholder:text-muted-foreground max-h-[120px] min-h-[28px] w-full resize-none bg-transparent py-1.5 text-[15px] leading-snug outline-none"
                                                aria-label="Message"
                                            />
                                        </div>
                                        <Button
                                            type="submit"
                                            size="icon"
                                            disabled={form.processing || !form.data.body.trim()}
                                            className={cn(
                                                'size-11 shrink-0 rounded-full shadow-sm',
                                                'bg-[#0084ff] hover:bg-[#0073e6] text-white disabled:opacity-40',
                                            )}
                                            aria-label="Send"
                                        >
                                            <Send className="size-5" />
                                        </Button>
                                    </div>
                                    {form.errors.body ? <p className="text-destructive px-1 text-xs">{form.errors.body}</p> : null}
                                </form>
                            </footer>
                        }
                    >
                        <div className="min-h-0 flex-1 overflow-y-auto px-3 py-4"
                            role="log"
                            aria-live="polite"
                        >
                            <div className="mx-auto flex max-w-2xl flex-col gap-1.5">
                                {messages.length === 0 ? (
                                    <p className="text-muted-foreground py-8 text-center text-sm">
                                        No messages yet. Say hello below.
                                    </p>
                                ) : (
                                    messages.map((m, i) => {
                                        const prev = messages[i - 1];
                                        const sameAsPrev = prev && prev.is_me === m.is_me;
                                        return (
                                            <div key={m.id} className={cn(sameAsPrev ? 'mt-0.5' : 'mt-2 first:mt-0')}>
                                                {!m.is_me && !sameAsPrev ? (
                                                    <p className="text-muted-foreground mb-1 pl-1 text-[11px] font-medium">
                                                        {m.sender_label}
                                                    </p>
                                                ) : null}
                                                <MessengerBubble
                                                    body={m.body}
                                                    createdAt={m.created_at}
                                                    isMe={m.is_me}
                                                />
                                            </div>
                                        );
                                    })
                                )}
                                <div ref={endRef} className="h-1 shrink-0" aria-hidden />
                            </div>
                        </div>
                    </MessengerThreadChrome>
                </div>
            </AccountShell>
        </SiteLayout>
    );
}
