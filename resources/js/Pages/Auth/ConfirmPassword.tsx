import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { GuestAuthLayout } from '@/layouts/guest-auth-layout';

export default function ConfirmPassword() {
    const form = useForm({
        password: '',
    });

    return (
        <GuestAuthLayout
            title="Confirm password"
            description="This is a secure area. Please confirm your password before continuing."
        >
            <form
                className="space-y-6"
                onSubmit={(e) => {
                    e.preventDefault();
                    form.post('/confirm-password');
                }}
            >
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
                        autoFocus
                        autoComplete="current-password"
                    />
                    {form.errors.password ? <p className="text-destructive mt-2 text-sm">{form.errors.password}</p> : null}
                </div>

                <Button type="submit" className="w-full" disabled={form.processing}>
                    Confirm
                </Button>
            </form>
        </GuestAuthLayout>
    );
}
