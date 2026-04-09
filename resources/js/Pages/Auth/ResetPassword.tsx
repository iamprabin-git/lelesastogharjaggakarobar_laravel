import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { GuestAuthLayout } from '@/layouts/guest-auth-layout';

type Props = {
    token: string;
    email: string;
};

export default function ResetPassword({ token, email: initialEmail }: Props) {
    const form = useForm({
        token,
        email: initialEmail,
        password: '',
        password_confirmation: '',
    });

    return (
        <GuestAuthLayout title="Set a new password" description="Choose a strong password for your account.">
            <form
                className="space-y-6"
                onSubmit={(e) => {
                    e.preventDefault();
                    form.post('/reset-password');
                }}
            >
                <input type="hidden" name="token" value={form.data.token} readOnly />

                <div>
                    <Label htmlFor="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        value={form.data.email}
                        onChange={(e) => form.setData('email', e.target.value)}
                        className="mt-2"
                        required
                        autoComplete="username"
                    />
                    {form.errors.email ? <p className="text-destructive mt-2 text-sm">{form.errors.email}</p> : null}
                </div>

                <div>
                    <Label htmlFor="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        value={form.data.password}
                        onChange={(e) => form.setData('password', e.target.value)}
                        className="mt-2"
                        required
                        autoComplete="new-password"
                    />
                    {form.errors.password ? <p className="text-destructive mt-2 text-sm">{form.errors.password}</p> : null}
                </div>

                <div>
                    <Label htmlFor="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={form.data.password_confirmation}
                        onChange={(e) => form.setData('password_confirmation', e.target.value)}
                        className="mt-2"
                        required
                        autoComplete="new-password"
                    />
                </div>

                <Button type="submit" className="w-full" disabled={form.processing}>
                    Reset password
                </Button>

                <p className="text-muted-foreground text-center text-sm">
                    <Link href="/login" className="text-primary font-medium hover:underline">
                        Back to sign in
                    </Link>
                </p>
            </form>
        </GuestAuthLayout>
    );
}
