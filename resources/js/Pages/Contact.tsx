import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { SiteLayout } from '@/layouts/site-layout';

export default function Contact() {
    const form = useForm({
        name: '',
        email: '',
        message: '',
    });

    return (
        <SiteLayout title="Contact">
            <section className="bg-muted/30 py-16">
                <div className="container mx-auto max-w-xl px-4">
                    <h1 className="mb-2 text-center text-3xl font-bold">Contact us</h1>
                    <p className="text-muted-foreground mb-8 text-center text-sm">We will get back to you as soon as we can.</p>
                    <form
                        className="bg-card space-y-4 rounded-2xl border p-8 shadow-sm"
                        onSubmit={(e) => {
                            e.preventDefault();
                            form.post('/contact', { preserveScroll: true });
                        }}
                    >
                        <div>
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                value={form.data.name}
                                onChange={(e) => form.setData('name', e.target.value)}
                                required
                            />
                            {form.errors.name && <p className="text-destructive mt-1 text-xs">{form.errors.name}</p>}
                        </div>
                        <div>
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                value={form.data.email}
                                onChange={(e) => form.setData('email', e.target.value)}
                                required
                            />
                            {form.errors.email && <p className="text-destructive mt-1 text-xs">{form.errors.email}</p>}
                        </div>
                        <div>
                            <Label htmlFor="message">Message</Label>
                            <Textarea
                                id="message"
                                rows={5}
                                value={form.data.message}
                                onChange={(e) => form.setData('message', e.target.value)}
                                required
                            />
                            {form.errors.message && <p className="text-destructive mt-1 text-xs">{form.errors.message}</p>}
                        </div>
                        <Button type="submit" disabled={form.processing} className="w-full">
                            Send message
                        </Button>
                    </form>
                </div>
            </section>
        </SiteLayout>
    );
}
