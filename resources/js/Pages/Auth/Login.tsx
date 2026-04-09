import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { GuestAuthLayout } from '@/layouts/guest-auth-layout';
import { cn } from '@/lib/utils';

type Props = {
    status?: string | null;
    canResetPassword: boolean;
};

export default function Login({ status, canResetPassword }: Props) {
    const form = useForm({
        email: '',
        password: '',
        remember: false as boolean,
    });

    return (
        <GuestAuthLayout title="Welcome back" description="Sign in to continue exploring properties">
            {status ? (
                <p className="text-center text-sm text-emerald-600 dark:text-emerald-400" role="status">
                    {status}
                </p>
            ) : null}

            <form
                className="space-y-6"
                onSubmit={(e) => {
                    e.preventDefault();
                    form.post('/login');
                }}
            >
                <div>
                    <Label htmlFor="email">Email address</Label>
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
                        autoComplete="current-password"
                    />
                    {form.errors.password ? <p className="text-destructive mt-2 text-sm">{form.errors.password}</p> : null}
                </div>

                <div className="flex flex-wrap items-center justify-between gap-4">
                    <label className="text-muted-foreground flex cursor-pointer items-center gap-2 text-sm">
                        <input
                            type="checkbox"
                            name="remember"
                            checked={form.data.remember}
                            onChange={(e) => form.setData('remember', e.target.checked)}
                            className={cn(
                                'border-input text-primary focus:ring-ring size-4 rounded border shadow-xs',
                                'focus:ring-2 focus:ring-offset-0',
                            )}
                        />
                        Remember me
                    </label>
                    {canResetPassword ? (
                        <Link href="/forgot-password" className="text-primary text-sm font-medium hover:underline">
                            Forgot your password?
                        </Link>
                    ) : null}
                </div>

                <Button type="submit" className="w-full" disabled={form.processing}>
                    Sign in
                </Button>

                <div className="pt-2">
                    <a
                        href="/google/login"
                        className="border-input bg-background text-foreground hover:bg-accent inline-flex w-full items-center justify-center gap-3 rounded-md border px-4 py-2.5 text-sm font-medium shadow-xs transition-colors focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50"
                    >
                        <svg className="size-5" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.51h5.84c-.25 1.31-.98 2.42-2.07 3.16v2.63h3.35c1.96-1.81 3.09-4.47 3.09-7.8z"
                            />
                            <path
                                fill="#34A853"
                                d="M12 23c2.97 0 5.46-1.01 7.28-2.73l-3.35-2.63c-1.01.68-2.29 1.08-3.93 1.08-3.02 0-5.58-2.04-6.49-4.79H.96v2.67C2.75 20.94 6.98 23 12 23z"
                            />
                            <path
                                fill="#FBBC05"
                                d="M5.51 14.21c-.23-.68-.36-1.41-.36-2.21s.13-1.53.36-2.21V7.34H.96C.35 8.85 0 10.39 0 12s.35 3.15.96 4.66l4.55-2.45z"
                            />
                            <path
                                fill="#EA4335"
                                d="M12 4.98c1.64 0 3.11.56 4.27 1.66l3.19-3.19C17.46 1.01 14.97 0 12 0 6.98 0 2.75 2.06.96 5.34l4.55 2.45C6.42 5.02 8.98 4.98 12 4.98z"
                            />
                        </svg>
                        Continue with Google
                    </a>
                </div>

                <p className="text-muted-foreground text-center text-sm">
                    Don&apos;t have an account?{' '}
                    <Link href="/register" className="text-primary font-medium hover:underline">
                        Sign up
                    </Link>
                </p>
            </form>
        </GuestAuthLayout>
    );
}
