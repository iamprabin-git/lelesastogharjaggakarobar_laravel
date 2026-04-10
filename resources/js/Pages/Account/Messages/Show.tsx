import { Link, useForm } from '@inertiajs/react';
import { ArrowLeft } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Textarea } from '@/components/ui/textarea';
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

export default function MessagesShow({
    conversation,
    messages,
}: {
    conversation: {
        id: number;
        subject: string;
        status: string;
        is_open: boolean;
    };
    messages: Msg[];
}) {
    const form = useForm({ body: '' });

    function send(e: React.FormEvent) {
        e.preventDefault();
        form.post(`/account/messages/${conversation.id}/messages`, {
            preserveScroll: true,
            onSuccess: () => form.reset('body'),
        });
    }

    return (
        <SiteLayout title={conversation.subject}>
            <AccountShell>
            <div className="border-b">
                <div className="container mx-auto max-w-3xl px-4 py-6">
                    <Button variant="ghost" size="sm" className="mb-4 gap-2 px-0" asChild>
                        <Link href="/account/messages">
                            <ArrowLeft className="size-4" />
                            All messages
                        </Link>
                    </Button>
                    <h1 className="text-2xl font-bold tracking-tight">{conversation.subject}</h1>
                    {!conversation.is_open && (
                        <p className="text-muted-foreground mt-2 text-sm">
                            This thread is closed. You can still read the history; contact us to reopen if needed.
                        </p>
                    )}
                </div>
            </div>

            <div className="container mx-auto max-w-3xl px-4 py-8">
                <div className="space-y-4">
                    {messages.map((m) => (
                        <div
                            key={m.id}
                            className={cn('flex', m.is_me ? 'justify-end' : 'justify-start')}
                        >
                            <Card
                                className={cn(
                                    'max-w-[85%] py-0',
                                    m.is_me
                                        ? 'bg-primary text-primary-foreground border-primary'
                                        : 'bg-muted/60',
                                )}
                            >
                                <CardContent className="p-4">
                                    <p className="text-xs font-medium opacity-80">{m.sender_label}</p>
                                    <p className="mt-2 whitespace-pre-wrap text-sm leading-relaxed">{m.body}</p>
                                    <time
                                        className={cn('mt-2 block text-xs opacity-70')}
                                        dateTime={m.created_at}
                                    >
                                        {new Date(m.created_at).toLocaleString()}
                                    </time>
                                </CardContent>
                            </Card>
                        </div>
                    ))}
                </div>

                {conversation.is_open ? (
                    <form onSubmit={send} className="mt-10 space-y-3">
                        <Textarea
                            required
                            rows={4}
                            value={form.data.body}
                            onChange={(e) => form.setData('body', e.target.value)}
                            placeholder="Type your message…"
                            className="resize-none"
                        />
                        {form.errors.body && <p className="text-destructive text-sm">{form.errors.body}</p>}
                        <Button type="submit" disabled={form.processing}>
                            Send message
                        </Button>
                    </form>
                ) : null}
            </div>
            </AccountShell>
        </SiteLayout>
    );
}
