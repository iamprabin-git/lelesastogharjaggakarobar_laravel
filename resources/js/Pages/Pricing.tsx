import { Link, usePage } from '@inertiajs/react';
import { FaqSection, type FaqEntry } from '@/components/faq-section';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { SiteLayout } from '@/layouts/site-layout';

const plans: {
    name: string;
    price: string;
    highlight: boolean;
    items: string[];
}[] = [
    {
        name: 'Free Plan',
        price: 'Rs. 0',
        highlight: false,
        items: ['1 month listing duration', 'Basic property listing', 'High quality images of property', 'Reach limited visitors'],
    },
    {
        name: 'Featured Plan',
        price: 'Rs. 6,000',
        highlight: true,
        items: [
            '4 months listing duration',
            '2 weeks Facebook sponsored promotion',
            'High quality images of property',
            'Walkthrough Video promotion',
            'Potential customer referral / Access to Demands',
            'Full Social media promotion',
        ],
    },
    {
        name: 'Premium Plan',
        price: 'Rs. 12,000',
        highlight: false,
        items: [
            'Unlimited listing duration',
            '1 month Facebook sponsored promotion',
            'Inquiry handling & time management',
            'Potential customer referral / Access to Demands',
            'High quality images of property',
            'Suitable for Urgent sale',
            'Walkthrough Video promotion',
            'Full Social media promotion',
        ],
    },
    {
        name: 'Pro Plan',
        price: 'Rs. 18,000',
        highlight: false,
        items: [
            'Suitable for Agents / Agencies',
            'Unlimited listing duration',
            '1.5 months Facebook sponsored promotion',
            'Inquiry handling & time management',
            'Access to demands & recommendations',
            'High quality images of property',
            'Suitable for Urgent sale',
            'Walkthrough Video promotion',
            'Full Social media promotion',
            'Suitable for high end & large properties',
        ],
    },
];

export default function Pricing() {
    const { faqs } = usePage<{ faqs: FaqEntry[] }>().props;

    return (
        <SiteLayout title="Pricing">
            <section className="relative flex min-h-[320px] items-center justify-center overflow-hidden text-primary-foreground">
                <img src="/images/price-hero.jpg" alt="" className="absolute inset-0 h-full w-full object-cover opacity-90" />
                <div className="absolute inset-0 bg-black/50" />
                <div className="relative z-10 container mx-auto max-w-3xl px-6 text-center">
                    <h1 className="text-3xl font-bold tracking-tight md:text-5xl">
                        आफ्नो घर जग्गा 0% कमिसनमा तुरुन्त बिक्रि गर्नुहोस
                    </h1>
                    <p className="mt-4 text-lg text-white/90">
                        Our personalised property promotion techniques &amp; team of real estate experts will help you to sell or rent your
                        properties instantly.
                    </p>
                    <p className="mt-6 font-semibold">
                        Customer Care:{' '}
                        <a href="tel:+9779765726294" className="text-primary underline decoration-primary/80 underline-offset-2">
                            +977-9765726294 | Message us on whatsapp only
                        </a>
                    </p>
                </div>
            </section>

            <section className="bg-muted/40 py-16">
                <div className="container mx-auto px-6">
                    <h2 className="mb-10 text-center text-3xl font-bold">Advertisement plans &amp; pricing</h2>
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                        {plans.map((plan) => (
                            <Card
                                key={plan.name}
                                className={
                                    plan.highlight
                                        ? 'border-primary ring-primary/20 flex flex-col border-2 shadow-md ring-2'
                                        : 'flex flex-col border-2 border-border'
                                }
                            >
                                <CardHeader>
                                    <CardTitle>{plan.name}</CardTitle>
                                    <p className="text-primary text-2xl font-semibold">{plan.price}</p>
                                </CardHeader>
                                <CardContent className="mt-auto flex flex-1 flex-col">
                                    <ul className="text-muted-foreground mb-6 list-inside list-disc space-y-1 text-sm">
                                        {plan.items.map((li) => (
                                            <li key={li}>{li}</li>
                                        ))}
                                    </ul>
                                    <Button asChild className="mt-auto">
                                        <Link href="/qr">Start my ads</Link>
                                    </Button>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                </div>
            </section>

            {faqs.length > 0 && (
                <FaqSection
                    faqs={faqs}
                    titleAs="h2"
                    limit={6}
                    footerLink={{ href: '/faqs', label: 'View all FAQs' }}
                />
            )}
        </SiteLayout>
    );
}
