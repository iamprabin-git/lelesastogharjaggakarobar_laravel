import { Link, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { SiteLayout } from '@/layouts/site-layout';

export default function Qr() {
    const { auth } = usePage<{ auth: { user: { id: number } | null } }>().props;
    const [panel, setPanel] = useState<'qr' | 'bank' | null>(null);

    const payForm = useForm({
        plan_name: '',
        amount: '',
        transaction_id: '',
        payment_method: 'qr',
        screenshot: null as File | null,
    });

    return (
        <SiteLayout title="Payment">
            <section className="bg-muted/30 py-16">
                <div className="container mx-auto max-w-4xl px-6 text-center">
                    <h1 className="mb-4 text-3xl font-bold">Payment options</h1>
                    <p className="text-muted-foreground mb-10 text-sm">
                        Choose your preferred payment method for property listing, subscription, or advertisement plans.
                    </p>

                    <div className="flex flex-wrap justify-center gap-4">
                        <Button type="button" onClick={() => setPanel('qr')}>
                            QR payment
                        </Button>
                        <Button type="button" variant="outline" onClick={() => setPanel('bank')}>
                            Bank transfer
                        </Button>
                    </div>
                </div>
            </section>

            <Dialog open={panel === 'qr'} onOpenChange={(o) => !o && setPanel(null)}>
                            <DialogContent className="max-h-[90vh] overflow-y-auto sm:max-w-3xl">
                                <DialogHeader>
                                    <DialogTitle>Scan &amp; pay</DialogTitle>
                                </DialogHeader>
                                <div className="flex flex-col items-center justify-center gap-8 md:flex-row">
                                    <div className="text-center">
                                        <img src="/images/qr1.jpg" alt="QR 1" className="mx-auto mb-2 max-h-80 rounded-lg shadow" />
                                    </div>
                                    <div className="text-center">
                                        <img src="/images/qr2.jpg" alt="QR 2" className="mx-auto mb-2 max-h-80 rounded-lg shadow" />
                                    </div>
                                </div>
                                <p className="text-muted-foreground mt-4 text-center text-sm">
                                    After payment, send screenshot to{' '}
                                    <a
                                        href="mailto:info.lelesastogharjaggakarobar@gmail.com"
                                        className="text-primary font-semibold underline-offset-4 hover:underline"
                                    >
                                        info.lelesastogharjaggakarobar@gmail.com
                                    </a>
                                </p>
                            </DialogContent>
            </Dialog>

            <Dialog open={panel === 'bank'} onOpenChange={(o) => !o && setPanel(null)}>
                            <DialogContent className="max-h-[90vh] overflow-y-auto sm:max-w-3xl">
                                <DialogHeader>
                                    <DialogTitle>Bank transfer details</DialogTitle>
                                </DialogHeader>
                                <div className="grid gap-4 md:grid-cols-2">
                                    <Card>
                                        <CardContent className="space-y-3 p-4 text-sm">
                                            <p className="font-semibold">Lumbini Bikash Bank, Lele Branch</p>
                                            <p>
                                                <span className="text-muted-foreground">Account name:</span> Prabin Dangol
                                            </p>
                                            <p className="font-mono">0411020131907000001</p>
                                        </CardContent>
                                    </Card>
                                    <Card>
                                        <CardContent className="space-y-3 p-4 text-sm">
                                            <p className="font-semibold">eSewa</p>
                                            <p>
                                                <span className="text-muted-foreground">Account name:</span> Prabin Dangol
                                            </p>
                                            <p className="font-mono">+977-9808083620</p>
                                        </CardContent>
                                    </Card>
                                </div>
                                <p className="text-muted-foreground text-center text-xs">
                                    Please include your name/reference in the remarks. After transfer, send screenshot to WhatsApp:
                                    +977-9765726294
                                </p>
                                <p className="text-muted-foreground text-center text-sm">
                                    Email screenshot to{' '}
                                    <a
                                        href="mailto:info.lelesastogharjaggakarobar@gmail.com"
                                        className="text-primary font-semibold underline-offset-4 hover:underline"
                                    >
                                        info.lelesastogharjaggakarobar@gmail.com
                                    </a>
                                </p>
                            </DialogContent>
            </Dialog>

            <section className="container mx-auto px-6 py-12">
                {auth.user ? (
                    <Card className="mx-auto max-w-5xl gap-0 overflow-hidden p-0 py-0 shadow-xl md:grid md:grid-cols-2">
                        <div className="bg-muted relative hidden md:block">
                            <img src="/images/payment-verification.png" alt="" className="h-full w-full object-contain p-4" />
                        </div>
                        <CardContent className="p-8 md:p-10">
                            <h2 className="mb-2 text-center text-2xl font-bold">Payment verification</h2>
                            <p className="text-muted-foreground mb-6 text-center text-sm">
                                Submit your payment details. Our team will verify and activate your plan.
                            </p>
                            <form
                                className="space-y-4"
                                onSubmit={(e) => {
                                    e.preventDefault();
                                    payForm.post('/payment/store', { forceFormData: true, preserveScroll: true });
                                }}
                            >
                                <div>
                                    <Label htmlFor="plan_name">Plan name</Label>
                                    <Input
                                        id="plan_name"
                                        value={payForm.data.plan_name}
                                        onChange={(e) => payForm.setData('plan_name', e.target.value)}
                                        required
                                    />
                                    {payForm.errors.plan_name && (
                                        <p className="text-destructive text-xs">{payForm.errors.plan_name}</p>
                                    )}
                                </div>
                                <div>
                                    <Label htmlFor="amount">Amount</Label>
                                    <Input
                                        id="amount"
                                        type="number"
                                        step="0.01"
                                        value={payForm.data.amount}
                                        onChange={(e) => payForm.setData('amount', e.target.value)}
                                        required
                                    />
                                    {payForm.errors.amount && <p className="text-destructive text-xs">{payForm.errors.amount}</p>}
                                </div>
                                <div>
                                    <Label htmlFor="payment_method">Method</Label>
                                    <div className="mt-1 w-full">
                                        <Select
                                            value={payForm.data.payment_method}
                                            onValueChange={(v) => payForm.setData('payment_method', v)}
                                        >
                                            <SelectTrigger id="payment_method" className="w-full">
                                                <SelectValue placeholder="Payment method" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value="qr">QR</SelectItem>
                                                <SelectItem value="bank_transfer">Bank transfer</SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    {payForm.errors.payment_method && (
                                        <p className="text-destructive text-xs">{payForm.errors.payment_method}</p>
                                    )}
                                </div>
                                <div>
                                    <Label htmlFor="transaction_id">Transaction ID (optional)</Label>
                                    <Input
                                        id="transaction_id"
                                        value={payForm.data.transaction_id}
                                        onChange={(e) => payForm.setData('transaction_id', e.target.value)}
                                    />
                                </div>
                                <div>
                                    <Label htmlFor="screenshot">Screenshot</Label>
                                    <Input
                                        id="screenshot"
                                        type="file"
                                        accept="image/*"
                                        className="mt-1 cursor-pointer"
                                        required
                                        onChange={(e) => payForm.setData('screenshot', e.target.files?.[0] ?? null)}
                                    />
                                    {payForm.errors.screenshot && (
                                        <p className="text-destructive text-xs">{payForm.errors.screenshot}</p>
                                    )}
                                </div>
                                <Button type="submit" disabled={payForm.processing} className="w-full">
                                    Submit payment
                                </Button>
                            </form>
                        </CardContent>
                    </Card>
                ) : (
                    <Card className="text-muted-foreground mx-auto max-w-md text-center text-sm">
                        <CardContent className="p-8">
                            <p className="mb-4">Log in to submit payment verification.</p>
                            <Button asChild>
                                <Link href="/login">Log in</Link>
                            </Button>
                        </CardContent>
                    </Card>
                )}
            </section>
        </SiteLayout>
    );
}
