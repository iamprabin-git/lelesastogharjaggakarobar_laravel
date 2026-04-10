import { Link, useForm } from '@inertiajs/react';
import { MessageCircle, Plus } from 'lucide-react';
import { useState } from 'react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { AccountShell } from '@/layouts/account-shell';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';

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
    const [open, setOpen] = useState(false);
    const form = useForm({
        subject: '',
        body: '',
    });

    function submitNew(e: React.FormEvent) {
        e.preventDefault();
        form.post('/account/messages', {
            preserveScroll: true,
            onSuccess: () => {
                setOpen(false);
                form.reset();
            },
        });
    }

    return (
        <SiteLayout title="Messages">
            <AccountShell>
            <div className="from-muted/30 border-b bg-linear-to-b to-background">
                <div className="container mx-auto flex flex-col gap-4 px-4 py-10 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight">Messages</h1>
                        <p className="text-muted-foreground mt-1 max-w-xl text-sm">
                            Chat with our team. Replies appear here — refresh the page to see new messages from support.
                        </p>
                    </div>
                    <Dialog open={open} onOpenChange={setOpen}>
                        <DialogTrigger asChild>
                            <Button className="shrink-0 gap-2">
                                <Plus className="size-4" />
                                New conversation
                            </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-lg">
                            <DialogHeader>
                                <DialogTitle>Start a conversation</DialogTitle>
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
                                    {form.errors.body && (
                                        <p className="text-destructive mt-1 text-sm">{form.errors.body}</p>
                                    )}
                                </div>
                                <div className="flex justify-end gap-2">
                                    <Button type="button" variant="secondary" onClick={() => setOpen(false)}>
                                        Cancel
                                    </Button>
                                    <Button type="submit" disabled={form.processing}>
                                        Send
                                    </Button>
                                </div>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>
            </div>

            <div className="container mx-auto max-w-3xl px-4 py-10">
                {conversations.length === 0 ? (
                    <Card>
                        <CardHeader className="text-center">
                            <MessageCircle className="text-muted-foreground mx-auto size-12" strokeWidth={1.25} />
                            <CardTitle>No threads yet</CardTitle>
                            <CardDescription>Start a conversation to reach our support team.</CardDescription>
                        </CardHeader>
                    </Card>
                ) : (
                    <ul className="space-y-3">
                        {conversations.map((c) => (
                            <li key={c.id}>
                                <Link
                                    href={`/account/messages/${c.id}`}
                                    className={cn(
                                        'border-border bg-card block rounded-2xl border p-5 shadow-sm transition-all',
                                        'hover:border-primary/30 hover:shadow-md',
                                        c.unread && 'border-primary/25 ring-primary/10 ring-2',
                                    )}
                                >
                                    <div className="flex items-start justify-between gap-3">
                                        <div className="min-w-0">
                                            <p className="font-semibold tracking-tight">{c.subject}</p>
                                            {c.preview && (
                                                <p className="text-muted-foreground mt-1 line-clamp-2 text-sm">{c.preview}</p>
                                            )}
                                            <div className="mt-2 flex flex-wrap items-center gap-2">
                                                <Badge variant={c.is_open ? 'secondary' : 'outline'}>
                                                    {c.is_open ? 'Open' : 'Closed'}
                                                </Badge>
                                                {c.unread && (
                                                    <Badge className="bg-primary text-primary-foreground">Unread</Badge>
                                                )}
                                            </div>
                                        </div>
                                        {c.last_message_at && (
                                            <time
                                                className="text-muted-foreground shrink-0 text-xs whitespace-nowrap"
                                                dateTime={c.last_message_at}
                                            >
                                                {new Date(c.last_message_at).toLocaleString()}
                                            </time>
                                        )}
                                    </div>
                                </Link>
                            </li>
                        ))}
                    </ul>
                )}
            </div>
            </AccountShell>
        </SiteLayout>
    );
}
