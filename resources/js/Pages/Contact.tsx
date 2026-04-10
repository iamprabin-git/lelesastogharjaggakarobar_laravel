import { useForm, usePage } from '@inertiajs/react';
import { Clock, Mail, MapPin, Phone, Send } from 'lucide-react';
import type { ReactNode } from 'react';
import { FaqSection, type FaqEntry } from '@/components/faq-section';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';

type SharedCompany = {
    name?: string | null;
    email?: string | null;
    phone?: string | null;
    address?: string | null;
    facebook?: string | null;
    instagram?: string | null;
    youtube?: string | null;
    tiktok?: string | null;
    whatsapp?: string | null;
} | null;

function ContactDetail({
    icon: Icon,
    title,
    children,
    className,
}: {
    icon: typeof MapPin;
    title: string;
    children: ReactNode;
    className?: string;
}) {
    return (
        <div
            className={cn(
                'border-border/80 bg-card/80 hover:border-primary/20 flex gap-4 rounded-2xl border p-5 shadow-sm backdrop-blur-sm transition-colors',
                className,
            )}
        >
            <div className="bg-primary/10 text-primary flex h-11 w-11 shrink-0 items-center justify-center rounded-xl">
                <Icon className="h-5 w-5" aria-hidden />
            </div>
            <div className="min-w-0 flex-1">
                <h3 className="text-foreground text-sm font-semibold tracking-tight">{title}</h3>
                <div className="text-muted-foreground mt-1 text-sm leading-relaxed">{children}</div>
            </div>
        </div>
    );
}

export default function Contact() {
    const { company, faqs } = usePage<{ company: SharedCompany; faqs: FaqEntry[] }>().props;

    const form = useForm({
        name: '',
        email: '',
        phone: '',
        message: '',
    });

    const displayName = company?.name ?? 'Lele Sasto Ghar Jagga Karobar Kendra';
    const mapQuery = company?.address?.trim() || 'Lalitpur, Nepal';
    const mapSrc = `https://maps.google.com/maps?q=${encodeURIComponent(mapQuery)}&t=&z=13&ie=UTF8&iwloc=&output=embed`;

    const socials = [
        { key: 'facebook', href: company?.facebook, label: 'Facebook' },
        { key: 'instagram', href: company?.instagram, label: 'Instagram' },
        { key: 'youtube', href: company?.youtube, label: 'YouTube' },
        { key: 'tiktok', href: company?.tiktok, label: 'TikTok' },
        { key: 'whatsapp', href: company?.whatsapp, label: 'WhatsApp' },
    ].filter((s): s is { key: string; href: string; label: string } => Boolean(s.href));

    return (
        <SiteLayout title="Contact">
            {/* Hero */}
            <section className="from-primary/[0.07] via-background to-background relative overflow-hidden bg-linear-to-b">
                <div className="pointer-events-none absolute inset-0 opacity-[0.35]"
                    style={{
                        backgroundImage: `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
                    }}
                />
                <div className="relative container mx-auto max-w-4xl px-4 py-16 text-center md:py-20">
                    <p className="text-primary mb-3 text-xs font-semibold uppercase tracking-[0.2em]">Contact</p>
                    <h1 className="text-foreground text-3xl font-bold tracking-tight md:text-4xl lg:text-5xl">
                        Let&apos;s talk about your next plot or home
                    </h1>
                    <p className="text-muted-foreground mx-auto mt-4 max-w-2xl text-base leading-relaxed md:text-lg">
                        Reach our team for listings, site visits, or general questions. We typically respond within one business day.
                    </p>
                </div>
            </section>

            <section className="container mx-auto max-w-6xl px-4 pb-20">
                <div className="grid gap-12 lg:grid-cols-12 lg:gap-14">
                    {/* Sidebar — company info */}
                    <div className="space-y-8 lg:col-span-5">
                        <div>
                            <h2 className="text-foreground text-xl font-semibold tracking-tight">{displayName}</h2>
                            <p className="text-muted-foreground mt-2 text-sm leading-relaxed">
                                Prefer a quick call or visit? Use the details below. For written requests, use the secure form — it
                                goes straight to our inbox.
                            </p>
                        </div>

                        <div className="space-y-3">
                            <ContactDetail icon={MapPin} title="Office">
                                {company?.address ? (
                                    <span>{company.address}</span>
                                ) : (
                                    <span className="text-muted-foreground/80">Address coming soon — call or email us below.</span>
                                )}
                            </ContactDetail>
                            <ContactDetail icon={Phone} title="Phone">
                                {company?.phone ? (
                                    <a href={`tel:${company.phone.replace(/\s+/g, '')}`} className="text-primary font-medium hover:underline">
                                        {company.phone}
                                    </a>
                                ) : (
                                    <span className="text-muted-foreground/80">Not on file</span>
                                )}
                            </ContactDetail>
                            <ContactDetail icon={Mail} title="Email">
                                {company?.email ? (
                                    <a href={`mailto:${company.email}`} className="text-primary font-medium hover:underline">
                                        {company.email}
                                    </a>
                                ) : (
                                    <span className="text-muted-foreground/80">Not on file</span>
                                )}
                            </ContactDetail>
                            <ContactDetail icon={Clock} title="Hours">
                                <span>Sunday–Friday · 10:00–17:00 NPT</span>
                                <span className="text-muted-foreground/70 mt-1 block text-xs">Saturday · By appointment</span>
                            </ContactDetail>
                        </div>

                        {socials.length > 0 && (
                            <div>
                                <p className="text-muted-foreground mb-3 text-xs font-medium uppercase tracking-wider">Follow</p>
                                <div className="flex flex-wrap gap-2">
                                    {socials.map((s) => (
                                        <a
                                            key={s.key}
                                            href={s.href ?? '#'}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className="border-border bg-background text-muted-foreground hover:border-primary/30 hover:text-primary inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-medium transition-colors"
                                        >
                                            {s.label}
                                        </a>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Form */}
                    <div className="lg:col-span-7">
                        <Card className="border-border/80 shadow-lg ring-1 ring-black/5 dark:ring-white/10">
                            <CardHeader className="space-y-1 border-b pb-6">
                                <CardTitle className="text-xl">Send a message</CardTitle>
                                <CardDescription>
                                    All fields marked with <span className="text-destructive">*</span> are required. We use your email
                                    only to reply to this inquiry.
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="pt-8">
                                <form
                                    className="space-y-6"
                                    onSubmit={(e) => {
                                        e.preventDefault();
                                        form.post('/contact', { preserveScroll: true });
                                    }}
                                >
                                    <div className="grid gap-6 sm:grid-cols-2">
                                        <div className="space-y-2">
                                            <Label htmlFor="name">
                                                Full name <span className="text-destructive">*</span>
                                            </Label>
                                            <Input
                                                id="name"
                                                autoComplete="name"
                                                placeholder="Your name"
                                                value={form.data.name}
                                                onChange={(e) => form.setData('name', e.target.value)}
                                                required
                                                className="h-11"
                                            />
                                            {form.errors.name && (
                                                <p className="text-destructive text-xs">{form.errors.name}</p>
                                            )}
                                        </div>
                                        <div className="space-y-2">
                                            <Label htmlFor="email">
                                                Email <span className="text-destructive">*</span>
                                            </Label>
                                            <Input
                                                id="email"
                                                type="email"
                                                autoComplete="email"
                                                placeholder="you@example.com"
                                                value={form.data.email}
                                                onChange={(e) => form.setData('email', e.target.value)}
                                                required
                                                className="h-11"
                                            />
                                            {form.errors.email && (
                                                <p className="text-destructive text-xs">{form.errors.email}</p>
                                            )}
                                        </div>
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="phone">Phone</Label>
                                        <Input
                                            id="phone"
                                            type="tel"
                                            autoComplete="tel"
                                            placeholder="+977 …"
                                            value={form.data.phone}
                                            onChange={(e) => form.setData('phone', e.target.value)}
                                            className="h-11"
                                        />
                                        {form.errors.phone && <p className="text-destructive text-xs">{form.errors.phone}</p>}
                                    </div>
                                    <div className="space-y-2">
                                        <Label htmlFor="message">
                                            Message <span className="text-destructive">*</span>
                                        </Label>
                                        <Textarea
                                            id="message"
                                            rows={6}
                                            placeholder="Tell us what you’re looking for — area, budget, timeline, or questions about a listing."
                                            value={form.data.message}
                                            onChange={(e) => form.setData('message', e.target.value)}
                                            required
                                            className="min-h-35 resize-y"
                                        />
                                        {form.errors.message && (
                                            <p className="text-destructive text-xs">{form.errors.message}</p>
                                        )}
                                    </div>
                                    <Button type="submit" size="lg" disabled={form.processing} className="h-11 w-full sm:w-auto sm:min-w-30">
                                        {form.processing ? (
                                            'Sending…'
                                        ) : (
                                            <>
                                                <Send className="mr-2 h-4 w-4" aria-hidden />
                                                Send message
                                            </>
                                        )}
                                    </Button>
                                </form>
                            </CardContent>
                        </Card>
                    </div>
                </div>

                {/* Map */}
                <div className="border-border mt-16 overflow-hidden rounded-2xl border shadow-sm">
                    <iframe
                        title="Office location"
                        src={mapSrc}
                        className="h-72 w-full md:h-96"
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                    />
                </div>
            </section>

            {faqs.length > 0 && (
                <FaqSection
                    faqs={faqs}
                    titleAs="h2"
                    title="Common questions"
                    limit={5}
                    footerLink={{ href: '/faqs', label: 'View all FAQs' }}
                />
            )}
        </SiteLayout>
    );
}
