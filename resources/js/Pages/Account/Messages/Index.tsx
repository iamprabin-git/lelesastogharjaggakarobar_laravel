import { Link, useForm } from '@inertiajs/react';
import { MessageCircle, SquarePen } from 'lucide-react';
import { useState } from 'react';
import {
    formatMessengerTime,
    MessengerListRow,
    MessengerPeerAvatar,
} from '@/components/account/messenger-chat';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { AccountShell } from '@/layouts/account-shell';
import { SiteLayout } from '@/layouts/site-layout';

type ConversationRow = {
    id: number;
    subject: string;
    status: string;
    is_open: boolean;
    last_message_at: string | null;
    preview: string | null;
    unread: boolean;
};

export default function MessagesIndex({ conversations }: { conversations: ConversationRow[] }) {
    const [composeOpen, setComposeOpen] = useState(false);
    const form = useForm({
        subject: '',
        body: '',
    });

    function submitNew(e: React.FormEvent) {
        e.preventDefault();
        form.post('/account/messages', {
            preserveScroll: true,
            onSuccess: () => {
                setComposeOpen(false);
                form.reset();
            },
        });
    }

    return (
        <SiteLayout title="Messages">
            <AccountShell>
                <div className="mx-auto w-full max-w-lg pb-4">
                    <div className="border-border bg-background mb-4 flex items-center justify-between gap-3 rounded-2xl border px-4 py-3 shadow-sm">
                        <div className="flex min-w-0 items-center gap-3">
                            <MessengerPeerAvatar title="Chats" size="sm" className="from-[#0084ff] to-[#0063c6] text-[11px]" />
                            <div className="min-w-0">
                                <h1 className="text-lg font-bold leading-tight tracking-tight">Chats</h1>
                                <p className="text-muted-foreground text-xs">With your team · like Messenger</p>
                            </div>
                        </div>
                        <Button
                            type="button"
                            size="icon"
                            className="size-11 shrink-0 rounded-full bg-[#0084ff] text-white shadow-sm hover:bg-[#0073e6]"
                            aria-label="New message"
                            onClick={() => setComposeOpen(true)}
                        >
                            <SquarePen className="size-5" aria-hidden />
                        </Button>
                    </div>

                    <Dialog open={composeOpen} onOpenChange={setComposeOpen}>
                        <DialogContent className="sm:max-w-lg">
                            <DialogHeader>
                                <DialogTitle>New message</DialogTitle>
                            </DialogHeader>
                            <form onSubmit={submitNew} className="space-y-4">
                                <div>
                                    <Label htmlFor="thread-subject">Subject (optional)</Label>
                                    <Input
                                        id="thread-subject"
                                        value={form.data.subject}
                                        onChange={(e) => form.setData('subject', e.target.value)}
                                        placeholder="e.g. Question about a listing"
                                        className="mt-1.5"
                                    />
                                </div>
                                <div>
                                    <Label htmlFor="thread-body">Message</Label>
                                    <Textarea
                                        id="thread-body"
                                        required
                                        rows={5}
                                        value={form.data.body}
                                        onChange={(e) => form.setData('body', e.target.value)}
                                        className="mt-1.5"
                                        placeholder="How can we help?"
                                    />
                                    {form.errors.body ? (
                                        <p className="text-destructive mt-1 text-sm">{form.errors.body}</p>
                                    ) : null}
                                </div>
                                <div className="flex justify-end gap-2">
                                    <Button type="button" variant="secondary" onClick={() => setComposeOpen(false)}>
                                        Cancel
                                    </Button>
                                    <Button type="submit" disabled={form.processing}>
                                        Send
                                    </Button>
                                </div>
                            </form>
                        </DialogContent>
                    </Dialog>

                    <div className="border-border bg-background overflow-hidden rounded-2xl border shadow-sm">
                        {conversations.length === 0 ? (
                            <div className="text-muted-foreground flex flex-col items-center gap-4 px-6 py-16 text-center">
                                <div className="flex size-16 items-center justify-center rounded-full bg-[#0084ff]/10 text-[#0084ff]">
                                    <MessageCircle className="size-8" strokeWidth={1.5} aria-hidden />
                                </div>
                                <div className="max-w-xs space-y-1">
                                    <p className="text-foreground text-base font-semibold">No chats yet</p>
                                    <p className="text-sm leading-relaxed">
                                        Tap New message to start a conversation. Replies appear here while you keep the
                                        chat open.
                                    </p>
                                </div>
                                <Button
                                    type="button"
                                    className="rounded-full bg-[#0084ff] px-6 text-white hover:bg-[#0073e6]"
                                    onClick={() => setComposeOpen(true)}
                                >
                                    New message
                                </Button>
                            </div>
                        ) : (
                            <div className="flex flex-col gap-0.5 p-2">
                                {conversations.map((c) => (
                                    <MessengerListRow
                                        key={c.id}
                                        href={`/account/messages/${c.id}`}
                                        title={c.subject}
                                        preview={c.preview}
                                        timeLabel={formatMessengerTime(c.last_message_at)}
                                        unread={c.unread}
                                    />
                                ))}
                            </div>
                        )}

                        <p className="text-muted-foreground border-t px-4 py-3 text-center text-[11px] leading-relaxed">
                            Need the full site?{' '}
                            <Link href="/" className="text-[#0084ff] font-medium hover:underline dark:text-[#5eb3ff]">
                                Home
                            </Link>
                        </p>
                    </div>
                </div>
            </AccountShell>
        </SiteLayout>
    );
}
