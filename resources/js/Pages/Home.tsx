import { useMemo, useState } from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { FaqSection } from '@/components/faq-section';
import { PropertyCardLink } from '@/components/property-card-link';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';
import type { PropertyCard } from '@/types/property';

const ALL = '__all__';

type Review = {
    id: number;
    author_name: string;
    profile_photo: string | null;
    rating: number;
    text: string;
};

type About = {
    hero_title: string;
    hero_description: string;
    hero_image: string | null;
    about_image: string | null;
    experience_years: string;
    properties_sold: number;
    happy_clients: number;
};

type Ad = { id: number; title: string | null; link: string | null; image: string | null };

type HomeFaq = { id: number; question: string; answer: string };

function chunkAds<T>(items: T[], size: number): T[][] {
    const slides: T[][] = [];
    for (let i = 0; i < items.length; i += size) {
        slides.push(items.slice(i, i + size));
    }
    return slides;
}

function AdvertisementCard({ ad }: { ad: Ad }) {
    const inner =
        ad.image ? (
            <img src={ad.image} alt={ad.title ?? 'Advertisement'} className="h-64 w-full object-contain md:h-80 lg:h-96" />
        ) : (
            <div className="bg-muted flex h-64 items-center justify-center md:h-80 lg:h-96">Ad</div>
        );

    return (
        <div className="relative overflow-hidden rounded-xl shadow-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
            {ad.link ? (
                <a href={ad.link} target="_blank" rel="noreferrer" className="block h-full w-full">
                    {inner}
                </a>
            ) : (
                inner
            )}
        </div>
    );
}

export default function Home({
    latestProperties,
    reviews,
    averageRating,
    totalReviews,
    about,
    advertisements,
    faqs,
}: {
    latestProperties: PropertyCard[];
    reviews: Review[];
    averageRating: number;
    totalReviews: number;
    about: About | null;
    advertisements: Ad[];
    faqs: HomeFaq[];
}) {
    const [type, setType] = useState(ALL);
    const [sort, setSort] = useState(ALL);

    const advertisementSlides = useMemo(() => chunkAds(advertisements, 2), [advertisements]);

    return (
        <SiteLayout title="Home">
            <section className="bg-muted/40 py-12">
                <div className="container mx-auto px-4">
                    <h2 className="mb-6 text-center text-3xl font-bold tracking-tight">Find your dream property</h2>
                    <form action="/properties" method="get" className="bg-card rounded-2xl border p-6 shadow-sm">
                        <input type="hidden" name="type" value={type === ALL ? '' : type} />
                        <input type="hidden" name="sort" value={sort === ALL ? '' : sort} />
                        <div className="grid gap-4 md:grid-cols-6">
                            <Input name="keyword" placeholder="Location, city…" className="md:col-span-2" />
                            <div className="w-full md:col-span-1">
                                <Select value={type} onValueChange={setType}>
                                    <SelectTrigger className="w-full">
                                        <SelectValue placeholder="Type" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value={ALL}>Any type</SelectItem>
                                        <SelectItem value="sale">For sale</SelectItem>
                                        <SelectItem value="rent">For rent</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <Input name="min_price" type="number" placeholder="Min price" />
                            <Input name="max_price" type="number" placeholder="Max price" />
                            <div className="w-full">
                                <Select value={sort} onValueChange={setSort}>
                                    <SelectTrigger className="w-full">
                                        <SelectValue placeholder="Sort" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value={ALL}>Default sort</SelectItem>
                                        <SelectItem value="low_high">Price: low → high</SelectItem>
                                        <SelectItem value="high_low">Price: high → low</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>
                        <div className="mt-4 flex flex-wrap gap-3">
                            <Button type="submit">Search</Button>
                            <Button type="button" variant="secondary" asChild>
                                <a href="/properties">Reset</a>
                            </Button>
                        </div>
                    </form>
                </div>
            </section>

            <section className="container mx-auto space-y-6 py-16 px-4 text-center">
                <h2 className="text-2xl font-bold">Agent registration</h2>
                <p className="text-muted-foreground">List properties with our team after you register.</p>
                <Button asChild>
                    <Link href="/agent-form">Register as agent</Link>
                </Button>
            </section>

            {about && (
                <section className="bg-muted/30 py-16">
                    <div className="container mx-auto grid items-center gap-10 px-4 md:grid-cols-2">
                        {about.about_image && (
                            <div className="relative">
                                <img src={about.about_image} alt="" className="h-80 w-full rounded-3xl object-cover shadow-xl md:h-112" />
                                <div className="bg-primary text-primary-foreground absolute -bottom-4 -right-4 rounded-2xl px-5 py-3 shadow-lg">
                                    <p className="text-2xl font-bold">{about.experience_years}+</p>
                                    <p className="text-xs">Years experience</p>
                                </div>
                            </div>
                        )}
                        <div>
                            <h2 className="mb-4 text-3xl font-bold">{about.hero_title}</h2>
                            <p className="text-muted-foreground mb-8 leading-relaxed">
                                {about.hero_description.length > 250
                                    ? `${about.hero_description.slice(0, 250)}…`
                                    : about.hero_description}
                            </p>
                            <div className="mb-8 grid grid-cols-3 gap-4">
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.properties_sold}+</p>
                                        <p className="text-muted-foreground text-xs">Sold</p>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.happy_clients}+</p>
                                        <p className="text-muted-foreground text-xs">Clients</p>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.experience_years}+</p>
                                        <p className="text-muted-foreground text-xs">Years</p>
                                    </CardContent>
                                </Card>
                            </div>
                            <Button asChild>
                                <Link href="/about">Read more</Link>
                            </Button>
                        </div>
                    </div>
                </section>
            )}

            <section className="container mx-auto py-16 px-4">
                <h2 className="bg-primary text-primary-foreground mb-8 rounded-lg py-3 text-center text-xl font-bold">
                    Latest properties
                </h2>
                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    {latestProperties.length === 0 && <p className="text-muted-foreground col-span-full text-center">No properties yet.</p>}
                    {latestProperties.map((p) => (
                        <PropertyCardLink key={p.id} p={p} />
                    ))}
                </div>
                <div className="mt-8 text-center">
                    <Button asChild variant="secondary">
                        <Link href="/properties">See all properties</Link>
                    </Button>
                </div>
            </section>

            {faqs.length > 0 && (
                <FaqSection
                    faqs={faqs}
                    titleAs="h2"
                    title="Frequently asked questions"
                    limit={6}
                    footerLink={{ href: '/faqs', label: 'View all FAQs' }}
                />
            )}

            <section className="bg-primary text-primary-foreground py-20 text-center">
                <div className="container mx-auto px-4">
                    <h2 className="mb-4 text-3xl font-bold">Ready to find your dream property?</h2>
                    <p className="mb-8 text-lg opacity-90">Our team can guide you at every step.</p>
                    <Button variant="secondary" size="lg" asChild>
                        <Link href="/contact">Contact us</Link>
                    </Button>
                </div>
            </section>

            {advertisements.length > 0 && (
                <section className="py-16">
                    <div className="container mx-auto px-4">
                        <h2 className="mb-2 text-center text-2xl font-bold">Advertisements</h2>
                        <p className="text-muted-foreground mb-8 text-center text-sm">Sponsored promotions</p>
                    </div>
                    <div className="w-full overflow-hidden">
                        <div
                            className={cn(
                                'flex gap-0',
                                advertisementSlides.length > 1 ? 'home-ad-marquee-track' : 'mx-auto justify-center',
                            )}
                        >
                            {(advertisementSlides.length > 1
                                ? [...advertisementSlides, ...advertisementSlides]
                                : advertisementSlides
                            ).map((pair, idx) => (
                                <div
                                    key={`${pair.map((a) => a.id).join('-')}-${idx}`}
                                    className="box-border flex min-w-[100vw] shrink-0 justify-center px-4 md:px-8"
                                >
                                    <div className="container mx-auto grid w-full max-w-6xl grid-cols-1 gap-6 md:grid-cols-2">
                                        {pair.map((ad) => (
                                            <AdvertisementCard key={`${ad.id}-${idx}`} ad={ad} />
                                        ))}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {reviews.length > 0 && (
                <section className="bg-muted/30 py-20">
                    <div className="container mx-auto px-4">
                        <div className="mb-12 text-center">
                            <div className="mb-2 flex items-center justify-center gap-2">
                                <span className="text-3xl font-bold">{averageRating.toFixed(1)}</span>
                                <span className="text-amber-500">{'★'.repeat(Math.min(5, Math.round(averageRating)))}</span>
                            </div>
                            <p className="text-muted-foreground text-sm">Based on {totalReviews} Google reviews</p>
                        </div>
                        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            {reviews.map((r) => (
                                <Card key={r.id}>
                                    <CardContent className="pt-6">
                                        <p className="text-amber-500 mb-3">{'★'.repeat(r.rating)}</p>
                                        <p className="text-muted-foreground mb-4 line-clamp-4">&ldquo;{r.text}&rdquo;</p>
                                        <div className="flex items-center gap-3">
                                            <img
                                                src={
                                                    r.profile_photo ??
                                                    `https://ui-avatars.com/api/?name=${encodeURIComponent(r.author_name)}`
                                                }
                                                alt=""
                                                className="size-10 rounded-full object-cover"
                                            />
                                            <div>
                                                <p className="font-medium">{r.author_name}</p>
                                                <p className="text-muted-foreground text-xs">Google review</p>
                                            </div>
                                        </div>
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </SiteLayout>
    );
}
