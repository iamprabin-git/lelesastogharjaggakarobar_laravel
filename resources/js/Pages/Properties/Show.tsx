import { Link, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';
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
import { Textarea } from '@/components/ui/textarea';
import { PropertyCardLink } from '@/components/property-card-link';
import { SiteLayout } from '@/layouts/site-layout';
import type { PropertyCard } from '@/types/property';

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

                        <div>
                            <h1 className="mb-2 text-3xl font-bold tracking-tight">{property.title}</h1>
                            <p className="text-muted-foreground text-sm">
                                {[property.location, property.city, property.state, property.country].filter(Boolean).join(' · ')}
                            </p>
                            <p className="text-primary mt-4 text-3xl font-bold">Rs. {property.price.toLocaleString()}</p>
                            <div className="text-muted-foreground mt-4 flex flex-wrap gap-6 text-sm">
                                <span>{property.bedrooms ?? 0} beds</span>
                                <span>{property.bathrooms ?? 0} baths</span>
                                <span>{property.area ?? 0} sq.ft</span>
                            </div>
                        </div>

                        {property.description && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Description</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-muted-foreground whitespace-pre-wrap">{property.description}</p>
                                </CardContent>
                            </Card>
                        )}

                        {property.amenities.length > 0 && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Nearby amenities</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-sm">
                                        {property.amenities.map((a) => (
                                            <li key={a.id}>
                                                <span className="font-medium">{a.name}</span>
                                                {a.distance != null && (
                                                    <span className="text-muted-foreground">
                                                        {' '}
                                                        — {a.distance}
                                                        {a.unit ? ` ${a.unit}` : ''}
                                                    </span>
                                                )}
                                            </li>
                                        ))}
                                    </ul>
                                </CardContent>
                            </Card>
                        )}

                        {mapHref && (
                            <Button variant="outline" asChild>
                                <a href={mapHref} target="_blank" rel="noreferrer">
                                    Open in Maps
                                </a>
                            </Button>
                        )}

                        <Card>
                            <CardHeader>
                                <CardTitle>Reviews ({reviewCount})</CardTitle>
                                {reviewCount > 0 && (
                                    <p className="text-muted-foreground text-sm">
                                        Average {reviewAverage.toFixed(1)} / 5
                                    </p>
                                )}
                            </CardHeader>
                            <CardContent className="space-y-6">
                                {approvedReviews.length === 0 && <p className="text-muted-foreground text-sm">No reviews yet.</p>}
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
                                            reviewForm.post(`/properties/${property.id}/reviews`, { preserveScroll: true });
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
                    </div>

                    <div className="space-y-6">
                        {property.agent && (
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
                                            contactForm.post(`/agent/${property.agent!.id}/contact`, { preserveScroll: true });
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
                        )}

                        {relatedProperties.length > 0 && (
                            <div>
                                <h2 className="mb-4 text-lg font-semibold">More in this area</h2>
                                <div className="space-y-6">
                                    {relatedProperties.map((p) => (
                                        <PropertyCardLink key={p.id} p={p} />
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </SiteLayout>
    );
}
