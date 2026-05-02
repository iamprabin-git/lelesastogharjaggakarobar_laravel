import { Link, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';
import type { LucideIcon } from 'lucide-react';
import {
    Bath,
    BedDouble,
    Bus,
    Car,
    Coffee,
    Dumbbell,
    Eye,
    Hospital,
    Landmark,
    MapPin,
    Maximize2,
    School,
    Shield,
    ShoppingBag,
    Train,
    Trees,
    UtensilsCrossed,
    Waves,
    Wifi,
} from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Separator } from '@/components/ui/separator';
import { sanitizeRichHtml } from '@/lib/sanitize-html';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Textarea } from '@/components/ui/textarea';
import { PropertyCardLink } from '@/components/property-card-link';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';
import type { PropertyCard } from '@/types/property';

function getAmenityIcon(name: string): LucideIcon {
    const n = name.toLowerCase();
    if (n.includes('school') || n.includes('college') || n.includes('university')) return School;
    if (n.includes('hospital') || n.includes('clinic') || n.includes('medical') || n.includes('pharmacy')) return Hospital;
    if (n.includes('park') || n.includes('garden') || n.includes('playground')) return Trees;
    if (n.includes('gym') || n.includes('fitness')) return Dumbbell;
    if (n.includes('mall') || n.includes('shop') || n.includes('market') || n.includes('store')) return ShoppingBag;
    if (n.includes('bus')) return Bus;
    if (n.includes('train') || n.includes('metro') || n.includes('station')) return Train;
    if (n.includes('airport') || n.includes('bank') || n.includes('atm')) return Landmark;
    if (n.includes('coffee') || n.includes('cafe')) return Coffee;
    if (n.includes('restaurant') || n.includes('dining') || n.includes('food')) return UtensilsCrossed;
    if (n.includes('pool') || n.includes('swim')) return Waves;
    if (n.includes('wifi') || n.includes('internet')) return Wifi;
    if (n.includes('police') || n.includes('security')) return Shield;
    if (n.includes('parking') || n.includes('garage')) return Car;
    return MapPin;
}

type Amenity = { id: number; name: string; distance: string | null; unit: string | null };

type Agent = {
    id: number;
    name: string;
    email: string;
    phone: string | null;
    avatar: string | null;
    facebook: string | null;
    twitter: string | null;
    linkedin: string | null;
    instagram: string | null;
};

type PropertyDetail = {
    id: number;
    title: string;
    view_count: number;
    description: string | null;
    price: number;
    type: string;
    availability: string;
    location: string | null;
    city: string | null;
    state: string | null;
    country: string | null;
    bedrooms: number | null;
    bathrooms: number | null;
    area: number | null;
    images: string[];
    youtube_link: string | null;
    youtube_embed: string | null;
    latitude: number | string | null;
    longitude: number | string | null;
    amenities: Amenity[];
    agent: Agent | null;
};

type Review = {
    id: number;
    rating: number;
    comment: string;
    created_at: string;
    user_name: string;
};

type UserReview = { status: string } | null;

export default function PropertyShow({
    property,
    relatedProperties,
    approvedReviews,
    reviewAverage,
    reviewCount,
    userReview,
}: {
    property: PropertyDetail;
    relatedProperties: PropertyCard[];
    approvedReviews: Review[];
    reviewAverage: number;
    reviewCount: number;
    userReview: UserReview;
}) {
    const { auth } = usePage<{ auth: { user: { id: number; name: string; email: string } | null } }>().props;
    const [imgIdx, setImgIdx] = useState(0);
    const images = property.images.length ? property.images : [];

    const contactForm = useForm({
        name: auth.user?.name ?? '',
        email: auth.user?.email ?? '',
        phone: '',
        message: '',
        property_id: property.id,
    });

    const reviewForm = useForm({
        rating: 5,
        comment: '',
    });

    const mapHref =
        property.latitude != null && property.longitude != null
            ? `https://www.google.com/maps?q=${property.latitude},${property.longitude}`
            : null;

    return (
        <SiteLayout title={property.title}>
            <div className="container mx-auto px-4 py-8">
                <div className="mb-6 flex flex-wrap gap-2">
                    <Badge className="capitalize">{property.type}</Badge>
                    <Badge variant="secondary" className="capitalize">
                        {property.availability}
                    </Badge>
                </div>

                <div className="grid gap-10 lg:grid-cols-3">
                    <div className="space-y-4 lg:col-span-2">
                        {images.length > 0 ? (
                            <>
                                <div className="relative aspect-[16/10] overflow-hidden rounded-2xl border bg-muted">
                                    <img src={images[imgIdx]} alt="" className="h-full w-full object-cover" />
                                </div>
                                {images.length > 1 && (
                                    <div className="flex flex-wrap gap-2">
                                        {images.map((src, i) => (
                                            <button
                                                key={src}
                                                type="button"
                                                onClick={() => setImgIdx(i)}
                                                className={`h-16 w-24 shrink-0 overflow-hidden rounded-md border-2 ${
                                                    i === imgIdx ? 'border-primary' : 'border-transparent opacity-70'
                                                }`}
                                            >
                                                <img src={src} alt="" className="h-full w-full object-cover" />
                                            </button>
                                        ))}
                                    </div>
                                )}
                            </>
                        ) : (
                            <div className="bg-muted text-muted-foreground flex aspect-[16/10] items-center justify-center rounded-2xl border">
                                No images
                            </div>
                        )}

                        {property.youtube_embed && (
                            <div className="aspect-video overflow-hidden rounded-xl border">
                                <iframe
                                    title="Property video"
                                    src={property.youtube_embed}
                                    className="h-full w-full"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowFullScreen
                                />
                            </div>
                        )}

                        <div className="bg-card rounded-2xl border p-5 shadow-sm sm:p-6">
                            <div className="mb-2 flex flex-wrap items-start justify-between gap-3 gap-y-2">
                                <h1 className="min-w-0 flex-1 text-3xl font-bold tracking-tight">{property.title}</h1>
                                <div
                                    className="text-muted-foreground flex shrink-0 items-center gap-1.5 rounded-lg border bg-muted/40 px-3 py-1.5 text-sm tabular-nums"
                                    title="Total page visits"
                                >
                                    <Eye className="text-primary size-4 shrink-0" aria-hidden />
                                    <span>
                                        {property.view_count.toLocaleString()}{' '}
                                        {property.view_count === 1 ? 'visit' : 'visits'}
                                    </span>
                                </div>
                            </div>
                            {[
                                property.location,
                                property.city,
                                property.state,
                                property.country,
                            ].filter(Boolean).length > 0 ? (
                                <p className="text-muted-foreground flex items-start gap-2 text-sm">
                                    <MapPin className="text-primary mt-0.5 size-4 shrink-0" aria-hidden />
                                    <span>
                                        {[property.location, property.city, property.state, property.country]
                                            .filter(Boolean)
                                            .join(' · ')}
                                    </span>
                                </p>
                            ) : null}
                            <p className="text-primary mt-4 text-3xl font-bold">Rs. {property.price.toLocaleString()}</p>

                            <div className="text-muted-foreground mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 border-y border-border/60 py-2.5 text-[11px] sm:gap-x-6">
                                <div className="flex items-center gap-1.5">
                                    <BedDouble className="text-primary/75 size-3.5 shrink-0" aria-hidden />
                                    <span className="tabular-nums leading-none">
                                        <span className="text-foreground text-[13px] font-semibold">{property.bedrooms ?? 0}</span>{' '}
                                        <span className="font-medium tracking-wide uppercase">beds</span>
                                    </span>
                                </div>
                                <span className="hidden h-3 w-px shrink-0 bg-border sm:block" aria-hidden />
                                <div className="flex items-center gap-1.5">
                                    <Bath className="text-primary/75 size-3.5 shrink-0" aria-hidden />
                                    <span className="tabular-nums leading-none">
                                        <span className="text-foreground text-[13px] font-semibold">{property.bathrooms ?? 0}</span>{' '}
                                        <span className="font-medium tracking-wide uppercase">baths</span>
                                    </span>
                                </div>
                                <span className="hidden h-3 w-px shrink-0 bg-border sm:block" aria-hidden />
                                <div className="flex items-center gap-1.5">
                                    <Maximize2 className="text-primary/75 size-3.5 shrink-0" aria-hidden />
                                    <span className="tabular-nums leading-none">
                                        <span className="text-foreground text-[13px] font-semibold">
                                            {(property.area ?? 0).toLocaleString()}
                                        </span>{' '}
                                        <span className="font-medium tracking-wide uppercase">sq.ft</span>
                                    </span>
                                </div>
                            </div>

                            <Separator className="my-6" />

                            <h2 className="text-muted-foreground mb-3 text-xs font-semibold tracking-wide uppercase">
                                Amenities & nearby
                            </h2>
                            {property.amenities.length > 0 ? (
                                <ul className="grid gap-3 sm:grid-cols-2">
                                    {property.amenities.map((a) => {
                                        const Icon = getAmenityIcon(a.name);
                                        return (
                                            <li
                                                key={a.id}
                                                className="bg-background flex gap-3 rounded-xl border p-3 text-sm shadow-xs"
                                            >
                                                <span className="bg-primary/10 text-primary flex size-10 shrink-0 items-center justify-center rounded-lg">
                                                    <Icon className="size-5" aria-hidden />
                                                </span>
                                                <div className="min-w-0">
                                                    <p className="font-medium leading-snug">{a.name}</p>
                                                    {a.distance != null && (
                                                        <p className="text-muted-foreground mt-0.5 text-xs">
                                                            {a.distance}
                                                            {a.unit ? ` ${a.unit}` : ''} away
                                                        </p>
                                                    )}
                                                </div>
                                            </li>
                                        );
                                    })}
                                </ul>
                            ) : (
                                <p className="text-muted-foreground text-sm">
                                    No amenities or nearby points are listed for this property yet.
                                </p>
                            )}
                        </div>

                        <Tabs defaultValue="details" className="w-full">
                            <TabsList className="grid h-10 w-full grid-cols-2 sm:inline-flex sm:w-auto">
                                <TabsTrigger value="details">Property details</TabsTrigger>
                                <TabsTrigger value="reviews">
                                    Reviews
                                    {reviewCount > 0 ? ` (${reviewCount})` : ''}
                                </TabsTrigger>
                            </TabsList>
                            <TabsContent value="details" className="mt-4 space-y-4">
                                {property.description ? (
                                    <Card>
                                        <CardHeader>
                                            <CardTitle>Description</CardTitle>
                                        </CardHeader>
                                        <CardContent>
                                            <div
                                                className={cn(
                                                    'text-muted-foreground max-w-none text-sm leading-relaxed',
                                                    '[&_a]:text-primary [&_a]:underline [&_blockquote]:border-l-2 [&_blockquote]:border-muted-foreground/30 [&_blockquote]:pl-4',
                                                    '[&_h1]:text-foreground [&_h1]:text-xl [&_h1]:font-semibold [&_h2]:text-foreground [&_h2]:text-lg [&_h2]:font-semibold',
                                                    '[&_li]:my-0.5 [&_ol]:my-3 [&_ol]:list-decimal [&_ol]:pl-6 [&_p]:mb-3 [&_p:last-child]:mb-0 [&_strong]:text-foreground',
                                                    '[&_ul]:my-3 [&_ul]:list-disc [&_ul]:pl-6',
                                                )}
                                                dangerouslySetInnerHTML={{
                                                    __html: sanitizeRichHtml(property.description),
                                                }}
                                            />
                                        </CardContent>
                                    </Card>
                                ) : (
                                    <p className="text-muted-foreground text-sm">No description provided.</p>
                                )}
                                {mapHref && (
                                    <Button variant="outline" asChild>
                                        <a href={mapHref} target="_blank" rel="noreferrer">
                                            Open in Maps
                                        </a>
                                    </Button>
                                )}
                            </TabsContent>
                            <TabsContent value="reviews" className="mt-4">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Reviews</CardTitle>
                                        {reviewCount > 0 && (
                                            <p className="text-muted-foreground text-sm">
                                                Average {reviewAverage.toFixed(1)} / 5 · {reviewCount} review
                                                {reviewCount === 1 ? '' : 's'}
                                            </p>
                                        )}
                                    </CardHeader>
                                    <CardContent className="space-y-6">
                                        {approvedReviews.length === 0 && (
                                            <p className="text-muted-foreground text-sm">No reviews yet.</p>
                                        )}
                                        {approvedReviews.map((r, idx) => (
                                            <div key={r.id}>
                                                <div className="mb-1 flex items-center justify-between gap-2">
                                                    <span className="font-medium">{r.user_name}</span>
                                                    <span className="text-primary text-sm" aria-hidden>
                                                        {'★'.repeat(r.rating)}
                                                    </span>
                                                </div>
                                                <p className="text-muted-foreground text-sm">{r.comment}</p>
                                                {idx < approvedReviews.length - 1 ? <Separator className="mt-4" /> : null}
                                            </div>
                                        ))}

                                        {auth.user && userReview && (
                                            <p className="text-muted-foreground text-sm">
                                                You already submitted a review (status: {userReview.status}).
                                            </p>
                                        )}

                                        {auth.user && !userReview && (
                                            <form
                                                className="space-y-4 border-t pt-6"
                                                onSubmit={(e) => {
                                                    e.preventDefault();
                                                    reviewForm.post(`/properties/${property.id}/reviews`, {
                                                        preserveScroll: true,
                                                    });
                                                }}
                                            >
                                                <div>
                                                    <Label htmlFor="rating">Rating</Label>
                                                    <div className="mt-1 w-full max-w-xs">
                                                        <Select
                                                            value={String(reviewForm.data.rating)}
                                                            onValueChange={(v) => reviewForm.setData('rating', Number(v))}
                                                        >
                                                            <SelectTrigger id="rating" className="w-full">
                                                                <SelectValue placeholder="Stars" />
                                                            </SelectTrigger>
                                                            <SelectContent>
                                                                {[5, 4, 3, 2, 1].map((n) => (
                                                                    <SelectItem key={n} value={String(n)}>
                                                                        {n} stars
                                                                    </SelectItem>
                                                                ))}
                                                            </SelectContent>
                                                        </Select>
                                                    </div>
                                                    {reviewForm.errors.rating && (
                                                        <p className="text-destructive mt-1 text-xs">{reviewForm.errors.rating}</p>
                                                    )}
                                                </div>
                                                <div>
                                                    <Label htmlFor="comment">Comment</Label>
                                                    <Textarea
                                                        id="comment"
                                                        className="mt-1"
                                                        rows={4}
                                                        value={reviewForm.data.comment}
                                                        onChange={(e) => reviewForm.setData('comment', e.target.value)}
                                                        required
                                                        minLength={10}
                                                    />
                                                    {reviewForm.errors.comment && (
                                                        <p className="text-destructive mt-1 text-xs">{reviewForm.errors.comment}</p>
                                                    )}
                                                </div>
                                                <Button type="submit" disabled={reviewForm.processing}>
                                                    Submit review
                                                </Button>
                                            </form>
                                        )}

                                        {!auth.user && (
                                            <p className="text-muted-foreground text-sm">
                                                <Link href="/login" className="text-primary font-medium underline">
                                                    Log in
                                                </Link>{' '}
                                                to leave a review.
                                            </p>
                                        )}
                                    </CardContent>
                                </Card>
                            </TabsContent>
                        </Tabs>
                    </div>

                    <aside className="min-h-0 space-y-6">
                        {property.agent && (
                            <div className="lg:sticky lg:top-28 lg:z-10 lg:max-h-[calc(100vh-8rem)] lg:overflow-y-auto lg:overscroll-contain">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Listing agent</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="flex items-center gap-3">
                                        {property.agent.avatar ? (
                                            <img
                                                src={property.agent.avatar}
                                                alt=""
                                                className="size-14 rounded-full border object-cover"
                                            />
                                        ) : (
                                            <div className="bg-muted size-14 rounded-full" />
                                        )}
                                        <div>
                                            <p className="font-semibold">{property.agent.name}</p>
                                            {property.agent.phone && (
                                                <a href={`tel:${property.agent.phone}`} className="text-primary text-sm">
                                                    {property.agent.phone}
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                    <form
                                        className="space-y-3"
                                        onSubmit={(e) => {
                                            e.preventDefault();
                                            contactForm.post(`/agent/${property.agent!.id}/contact`, {
                                                preserveScroll: true,
                                                onSuccess: () => {
                                                    contactForm.reset();
                                                    contactForm.setData({
                                                        name: auth.user?.name ?? '',
                                                        email: auth.user?.email ?? '',
                                                        phone: '',
                                                        message: '',
                                                        property_id: property.id,
                                                    });
                                                },
                                            });
                                        }}
                                    >
                                        <div>
                                            <Label htmlFor="cname">Your name</Label>
                                            <Input
                                                id="cname"
                                                value={contactForm.data.name}
                                                onChange={(e) => contactForm.setData('name', e.target.value)}
                                                required
                                            />
                                            {contactForm.errors.name && (
                                                <p className="text-destructive text-xs">{contactForm.errors.name}</p>
                                            )}
                                        </div>
                                        <div>
                                            <Label htmlFor="cemail">Email</Label>
                                            <Input
                                                id="cemail"
                                                type="email"
                                                value={contactForm.data.email}
                                                onChange={(e) => contactForm.setData('email', e.target.value)}
                                                required
                                            />
                                            {contactForm.errors.email && (
                                                <p className="text-destructive text-xs">{contactForm.errors.email}</p>
                                            )}
                                        </div>
                                        <div>
                                            <Label htmlFor="cphone">Phone (optional)</Label>
                                            <Input
                                                id="cphone"
                                                type="tel"
                                                autoComplete="tel"
                                                value={contactForm.data.phone}
                                                onChange={(e) => contactForm.setData('phone', e.target.value)}
                                            />
                                            {contactForm.errors.phone && (
                                                <p className="text-destructive text-xs">{contactForm.errors.phone}</p>
                                            )}
                                        </div>
                                        <div>
                                            <Label htmlFor="cmsg">Message</Label>
                                            <Textarea
                                                id="cmsg"
                                                rows={4}
                                                value={contactForm.data.message}
                                                onChange={(e) => contactForm.setData('message', e.target.value)}
                                                required
                                            />
                                            {contactForm.errors.message && (
                                                <p className="text-destructive text-xs">{contactForm.errors.message}</p>
                                            )}
                                        </div>
                                        <Button type="submit" disabled={contactForm.processing}>
                                            Contact agent
                                        </Button>
                                    </form>
                                </CardContent>
                            </Card>
                            </div>
                        )}
                    </aside>
                </div>

                {relatedProperties.length > 0 && (
                    <section className="mt-14 border-t pt-12" aria-labelledby="related-properties-heading">
                        <h2 id="related-properties-heading" className="mb-2 text-2xl font-bold tracking-tight">
                            Related properties
                        </h2>
                        <p className="text-muted-foreground mb-8 text-sm">
                            {property.city ? `More listings in ${property.city}.` : 'More listings you may like.'}
                        </p>
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {relatedProperties.map((p) => (
                                <PropertyCardLink key={p.id} p={p} />
                            ))}
                        </div>
                    </section>
                )}
            </div>
        </SiteLayout>
    );
}
