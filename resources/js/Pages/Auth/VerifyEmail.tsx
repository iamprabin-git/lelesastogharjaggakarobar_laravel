import { router } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { GuestAuthLayout } from '@/layouts/guest-auth-layout';

type Props = {
    status?: string | null;
};

export default function VerifyEmail({ status }: Props) {
    return (
        <GuestAuthLayout
            title="Verify email"
            description="Thanks for signing up! Before getting started, verify your email by clicking the link we emailed you."
        >
            {status === 'verification-link-sent' ? (
                <p className="mb-4 text-center text-sm font-medium text-emerald-600 dark:text-emerald-400">
                    A new verification link has been sent to your email address.
                </p>
            ) : null}

            <Button
                type="button"
                className="w-full"
                onClick={() => router.post('/email/verification-notification')}
            >
                Resend verification email
            </Button>

            <form
                className="mt-4"
                onSubmit={(e) => {
                    e.preventDefault();
                    router.post('/logout');
                }}
            >
                <Button type="submit" variant="ghost" className="w-full text-muted-foreground">
                    Log out
                </Button>
            </form>
        </GuestAuthLayout>
    );
}
