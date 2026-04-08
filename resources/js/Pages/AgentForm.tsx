import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { SiteLayout } from '@/layouts/site-layout';

export default function AgentForm() {
    const form = useForm({
        name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        avatar: null as File | null,
    });

    return (
        <SiteLayout title="Agent registration">
            <section className="bg-muted/30 py-16">
                <div className="container mx-auto max-w-lg px-4">
                    <h1 className="mb-2 text-center text-3xl font-bold">Register as agent</h1>
                    <p className="text-muted-foreground mb-8 text-center text-sm">
                        Submit your details for review. After an administrator activates your account, sign in at{' '}
                        <span className="text-foreground font-medium">/agent/login</span> using this email and password.
                    </p>
                    <form
                        className="bg-card space-y-4 rounded-2xl border p-8 shadow-sm"
                        encType="multipart/form-data"
                        onSubmit={(e) => {
                            e.preventDefault();
                            form.post('/agent-store', { forceFormData: true });
                        }}
                    >
                        <div>
                            <Label htmlFor="name">Full name</Label>
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
                            <Label htmlFor="phone">Phone</Label>
                            <Input
                                id="phone"
                                value={form.data.phone}
                                onChange={(e) => form.setData('phone', e.target.value)}
                                required
                            />
                            {form.errors.phone && <p className="text-destructive mt-1 text-xs">{form.errors.phone}</p>}
                        </div>
                        <div>
                            <Label htmlFor="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                value={form.data.password}
                                onChange={(e) => form.setData('password', e.target.value)}
                                required
                                minLength={6}
                            />
                            {form.errors.password && <p className="text-destructive mt-1 text-xs">{form.errors.password}</p>}
                        </div>
                        <div>
                            <Label htmlFor="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                value={form.data.password_confirmation}
                                onChange={(e) => form.setData('password_confirmation', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <Label htmlFor="avatar">Profile photo (optional)</Label>
                            <Input
                                id="avatar"
                                type="file"
                                accept="image/jpeg,image/png,image/jpg"
                                className="mt-1 cursor-pointer"
                                onChange={(e) => form.setData('avatar', e.target.files?.[0] ?? null)}
                            />
                            {form.errors.avatar && <p className="text-destructive mt-1 text-xs">{form.errors.avatar}</p>}
                        </div>
                        <Button type="submit" disabled={form.processing} className="w-full">
                            Register
                        </Button>
                    </form>
                </div>
            </section>
        </SiteLayout>
    );
}
