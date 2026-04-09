import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { GuestAuthLayout } from '@/layouts/guest-auth-layout';

type Props = {
    status?: string | null;
};

export default function ForgotPassword({ status }: Props) {
    const form = useForm({
        email: '',
    });

    return (
        <GuestAuthLayout
            title="Forgot password"
            description="Enter your email and we will send a reset link if an account exists."
        >
            {status ? (
                <p className="mb-4 text-center text-sm text-emerald-600 dark:text-emerald-400" role="status">
                    {status}
                </p>
            ) : null}

            <form
                className="space-y-6"
                onSubmit={(e) => {
                    e.preventDefault();
                    form.post('/forgot-password');
                }}
            >
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
                        autoFocus
                        autoComplete="username"
                    />
                    {form.errors.email ? <p className="text-destructive mt-2 text-sm">{form.errors.email}</p> : null}
                </div>

                <Button type="submit" className="w-full" disabled={form.processing}>
                    Email password reset link
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
