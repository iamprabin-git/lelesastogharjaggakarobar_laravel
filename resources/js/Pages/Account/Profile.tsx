import { router, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { AccountShell } from '@/layouts/account-shell';
import { SiteLayout } from '@/layouts/site-layout';

type User = {
    name: string;
    email: string;
    email_verified_at: string | null;
};

type PageErrors = {
    name?: string;
    email?: string;
    updatePassword?: Record<string, string>;
    userDeletion?: Record<string, string>;
};

type Props = {
    mustVerifyEmail: boolean;
    status?: string | null;
    user: User;
};

export default function Edit({ mustVerifyEmail, status, user }: Props) {
    const { errors: pageErrors } = usePage<{ errors: PageErrors }>().props;
    const profileForm = useForm({
        name: user.name,
        email: user.email,
    });

    const [passwordFields, setPasswordFields] = useState({
        current_password: '',
        password: '',
        password_confirmation: '',
    });
    const [deletePassword, setDeletePassword] = useState('');
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [pwdProcessing, setPwdProcessing] = useState(false);
    const [delProcessing, setDelProcessing] = useState(false);

    const pwErrors = pageErrors.updatePassword ?? {};
    const delErrors = pageErrors.userDeletion ?? {};

    return (
        <SiteLayout title="Profile">
            <AccountShell>
            <div className="container mx-auto max-w-2xl space-y-8 px-4 py-10">
                <section className="bg-card rounded-xl border p-6 shadow-sm sm:p-8">
                    <header className="mb-6">
                        <h2 className="text-lg font-semibold">Profile information</h2>
                        <p className="text-muted-foreground mt-1 text-sm">
                            Update your account profile and email address.
                        </p>
                    </header>

                    <form
                        className="space-y-6"
                        onSubmit={(e) => {
                            e.preventDefault();
                            profileForm.patch('/account/profile');
                        }}
                    >
                        <div>
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                value={profileForm.data.name}
                                onChange={(e) => profileForm.setData('name', e.target.value)}
                                className="mt-1"
                                required
                                autoComplete="name"
                            />
                            {profileForm.errors.name ? (
                                <p className="text-destructive mt-2 text-sm">{profileForm.errors.name}</p>
                            ) : null}
                        </div>

                        <div>
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                value={profileForm.data.email}
                                onChange={(e) => profileForm.setData('email', e.target.value)}
                                className="mt-1"
                                required
                                autoComplete="username"
                            />
                            {profileForm.errors.email ? (
                                <p className="text-destructive mt-2 text-sm">{profileForm.errors.email}</p>
                            ) : null}

                            {mustVerifyEmail && !user.email_verified_at ? (
                                <div className="mt-3 text-sm">
                                    <p className="text-foreground">Your email address is unverified.</p>
                                    <button
                                        type="button"
                                        className="text-primary mt-1 font-medium underline hover:no-underline"
                                        onClick={() => router.post('/email/verification-notification')}
                                    >
                                        Click here to re-send the verification email.
                                    </button>
                                    {status === 'verification-link-sent' ? (
                                        <p className="mt-2 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                            A new verification link has been sent to your email address.
                                        </p>
                                    ) : null}
                                </div>
                            ) : null}
                        </div>

                        <div className="flex flex-wrap items-center gap-4">
                            <Button type="submit" disabled={profileForm.processing}>
                                Save
                            </Button>
                            {status === 'profile-updated' ? (
                                <span className="text-muted-foreground text-sm">Saved.</span>
                            ) : null}
                        </div>
                    </form>
                </section>

                <section className="bg-card rounded-xl border p-6 shadow-sm sm:p-8">
                    <header className="mb-6">
                        <h2 className="text-lg font-semibold">Update password</h2>
                        <p className="text-muted-foreground mt-1 text-sm">
                            Use a long, random password to keep your account secure.
                        </p>
                    </header>

                    <form
                        className="space-y-6"
                        onSubmit={(e) => {
                            e.preventDefault();
                            setPwdProcessing(true);
                            router.put('/password', passwordFields, {
                                preserveScroll: true,
                                onFinish: () => setPwdProcessing(false),
                                onSuccess: () =>
                                    setPasswordFields({
                                        current_password: '',
                                        password: '',
                                        password_confirmation: '',
                                    }),
                            });
                        }}
                    >
                        <div>
                            <Label htmlFor="current_password">Current password</Label>
                            <Input
                                id="current_password"
                                type="password"
                                value={passwordFields.current_password}
                                onChange={(e) => setPasswordFields((p) => ({ ...p, current_password: e.target.value }))}
                                className="mt-1"
                                autoComplete="current-password"
                            />
                            {pwErrors.current_password ? (
                                <p className="text-destructive mt-2 text-sm">{pwErrors.current_password}</p>
                            ) : null}
                        </div>
                        <div>
                            <Label htmlFor="new_password">New password</Label>
                            <Input
                                id="new_password"
                                type="password"
                                value={passwordFields.password}
                                onChange={(e) => setPasswordFields((p) => ({ ...p, password: e.target.value }))}
                                className="mt-1"
                                autoComplete="new-password"
                            />
                            {pwErrors.password ? (
                                <p className="text-destructive mt-2 text-sm">{pwErrors.password}</p>
                            ) : null}
                        </div>
                        <div>
                            <Label htmlFor="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                value={passwordFields.password_confirmation}
                                onChange={(e) => setPasswordFields((p) => ({ ...p, password_confirmation: e.target.value }))}
                                className="mt-1"
                                autoComplete="new-password"
                            />
                            {pwErrors.password_confirmation ? (
                                <p className="text-destructive mt-2 text-sm">{pwErrors.password_confirmation}</p>
                            ) : null}
                        </div>
                        <div className="flex flex-wrap items-center gap-4">
                            <Button type="submit" disabled={pwdProcessing}>
                                Save
                            </Button>
                            {status === 'password-updated' ? (
                                <span className="text-muted-foreground text-sm">Saved.</span>
                            ) : null}
                        </div>
                    </form>
                </section>

                <section className="bg-card rounded-xl border p-6 shadow-sm sm:p-8">
                    <header className="mb-6">
                        <h2 className="text-lg font-semibold">Delete account</h2>
                        <p className="text-muted-foreground mt-1 text-sm">
                            Once deleted, your data is permanently removed. Download anything you need first.
                        </p>
                    </header>

                    <Button type="button" variant="destructive" onClick={() => setDeleteOpen(true)}>
                        Delete account
                    </Button>

                    <Dialog open={deleteOpen} onOpenChange={setDeleteOpen}>
                        <DialogContent className="sm:max-w-md">
                            <DialogHeader>
                                <DialogTitle>Delete account?</DialogTitle>
                                <p className="text-muted-foreground text-sm">
                                    Enter your password to confirm. This cannot be undone.
                                </p>
                            </DialogHeader>
                            <div className="space-y-4 py-2">
                                <div>
                                    <Label htmlFor="delete_password" className="sr-only">
                                        Password
                                    </Label>
                                    <Input
                                        id="delete_password"
                                        type="password"
                                        placeholder="Password"
                                        value={deletePassword}
                                        onChange={(e) => setDeletePassword(e.target.value)}
                                        autoComplete="current-password"
                                    />
                                    {delErrors.password ? (
                                        <p className="text-destructive mt-2 text-sm">{delErrors.password}</p>
                                    ) : null}
                                </div>
                            </div>
                            <div className="flex flex-col-reverse justify-end gap-2 sm:flex-row">
                                <Button type="button" variant="outline" onClick={() => setDeleteOpen(false)}>
                                    Cancel
                                </Button>
                                <Button
                                    type="button"
                                    variant="destructive"
                                    disabled={delProcessing}
                                    onClick={() => {
                                        setDelProcessing(true);
                                        router.delete('/account/profile', {
                                            data: { password: deletePassword },
                                            preserveScroll: true,
                                            onFinish: () => setDelProcessing(false),
                                            onError: () => setDelProcessing(false),
                                        });
                                    }}
                                >
                                    Delete account
                                </Button>
                            </div>
                        </DialogContent>
                    </Dialog>
                </section>
            </div>
            </AccountShell>
        </SiteLayout>
    );
}
