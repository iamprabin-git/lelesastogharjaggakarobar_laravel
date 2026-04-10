import { Link, router } from '@inertiajs/react';
import {
    ArrowRight,
    Building2,
    CheckCircle2,
    CreditCard,
    Mail,
    MapPin,
    MessageCircle,
    Phone,
    QrCode,
    Search,
    Sparkles,
    UserRound,
} from 'lucide-react';
import { useCallback, useEffect, useId, useRef, useState } from 'react';
import { PropertyCardLink } from '@/components/property-card-link';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Separator } from '@/components/ui/separator';
import { AccountShell } from '@/layouts/account-shell';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';
import type { PropertyCard } from '@/types/property';

const ALL = '__all__';

type RecentSearch = {
    id: number;
    label: string;
    params: Record<string, string>;
};

type Suggestion = {
    id: number;
    title: string;
    city: string | null;
    location: string | null;
    price: number;
    type: string;
};

type Support = {
    whatsapp_digits: string;
    messenger_url: string | null;
    email: string;
    phone_display: string | null;
    company_name: string | null;
};

function buildPropertiesUrl(params: Record<string, string>): string {
    const q = new URLSearchParams(params);
    const s = q.toString();

    return s ? `/properties?${s}` : '/properties';
}

function waUrl(digits: string, preset: string): string {
    const text = encodeURIComponent(preset);

    return `https://wa.me/${digits}?text=${text}`;
}

export default function Dashboard({
    user,
    stats,
    recentSearches,
    spotlightProperties,
    support,
}: {
    user: {
        name: string;
        email: string;
        email_verified_at: string | null;
        initials: string;
    };
    stats: { reviews_written: number };
    recentSearches: RecentSearch[];
    spotlightProperties: PropertyCard[];
    support: Support;
}) {
    const searchBoxId = useId();
    const [type, setType] = useState(ALL);
    const [bedrooms, setBedrooms] = useState(ALL);
    const [sort, setSort] = useState(ALL);
    const [keyword, setKeyword] = useState('');
    const [suggestions, setSuggestions] = useState<Suggestion[]>([]);
    const [suggestOpen, setSuggestOpen] = useState(false);
    const suggestWrapRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        const onDoc = (e: MouseEvent) => {
            if (!suggestWrapRef.current?.contains(e.target as Node)) {
                setSuggestOpen(false);
            }
        };
        document.addEventListener('click', onDoc);

        return () => document.removeEventListener('click', onDoc);
    }, []);

    useEffect(() => {
        const q = keyword.trim();
        if (q.length < 2) {
            setSuggestions([]);

            return;
        }

        const t = window.setTimeout(() => {
            void fetch(`/account/property-suggestions?q=${encodeURIComponent(q)}`, {
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
            })
                .then((r) => r.json() as Promise<Suggestion[]>)
                .then((rows) => {
                    setSuggestions(Array.isArray(rows) ? rows : []);
                    setSuggestOpen(true);
                })
                .catch(() => setSuggestions([]));
        }, 300);

        return () => window.clearTimeout(t);
    }, [keyword]);

    const onPickSuggestion = useCallback((s: Suggestion) => {
        router.visit(`/properties/${s.id}`);
    }, []);

    const verified = Boolean(user.email_verified_at);
    const waPreset = `Hello${support.company_name ? ` ${support.company_name}` : ''}, I'm ${user.name} (signed in on the website). I'd like help with a property.`;

    return (
        <SiteLayout title="Your account">
            <AccountShell>
            <div className="from-muted/40 bg-linear-to-b to-background border-b">
                <div className="container mx-auto px-4 py-10 lg:py-14">
                    <div className="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p className="text-muted-foreground text-sm font-medium tracking-wide uppercase">
                                Welcome back
                            </p>
                            <h1 className="mt-1 text-3xl font-bold tracking-tight md:text-4xl">{user.name}</h1>
                            <p className="text-muted-foreground mt-2 max-w-xl text-sm md:text-base">
                                Search land and homes, reach us on WhatsApp or email, and complete payments — all from
                                one place.
                            </p>
                        </div>
                        <Card className="border-primary/15 w-full max-w-md shadow-md lg:shrink-0">
                            <CardHeader className="pb-3">
                                <CardTitle className="flex items-center gap-2 text-lg">
                                    <UserRound className="text-primary size-5" aria-hidden />
                                    Your profile
                                </CardTitle>
                                <CardDescription>How you appear on reviews and inquiries.</CardDescription>
                            </CardHeader>
                            <CardContent className="flex flex-col gap-4 sm:flex-row sm:items-center">
                                <div
                                    className="bg-primary text-primary-foreground flex size-16 shrink-0 items-center justify-center rounded-2xl text-xl font-bold shadow-inner"
                                    aria-hidden
                                >
                                    {user.initials}
                                </div>
                                <div className="min-w-0 flex-1 space-y-1">
                                    <p className="truncate font-semibold">{user.name}</p>
                                    <p className="text-muted-foreground truncate text-sm">{user.email}</p>
                                    <div className="flex flex-wrap items-center gap-2 pt-1">
                                        {verified ? (
                                            <Badge variant="secondary" className="gap-1 font-normal">
                                                <CheckCircle2 className="size-3.5" aria-hidden />
                                                Email verified
                                            </Badge>
                                        ) : (
                                            <Badge variant="outline" className="font-normal">
                                                Email not verified
                                            </Badge>
                                        )}
                                        <Badge variant="outline" className="font-normal">
                                            {stats.reviews_written} review{stats.reviews_written === 1 ? '' : 's'}
                                        </Badge>
                                    </div>
                                    <Button variant="outline" size="sm" className="mt-3" asChild>
                                        <Link href="/account/profile">Edit profile &amp; security</Link>
                                    </Button>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>

            <div className="container mx-auto space-y-12 px-4 py-10 lg:py-12">
                <section>
                    <h2 className="mb-4 text-lg font-semibold tracking-tight">Quick actions</h2>
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <Link
                            href="/qr"
                            className="group border-border bg-card hover:border-primary/30 relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all hover:shadow-md"
                        >
                            <div className="bg-primary/10 text-primary mb-4 inline-flex rounded-xl p-3">
                                <QrCode className="size-6" strokeWidth={1.75} />
                            </div>
                            <h3 className="font-semibold">QR payment</h3>
                            <p className="text-muted-foreground mt-1 text-sm">Scan QR or bank transfer for plans.</p>
                            <div className="mt-4 flex gap-2">
                                <img
                                    src="/images/qr1.jpg"
                                    alt=""
                                    className="border-border h-14 w-14 rounded-lg border object-cover opacity-90 group-hover:opacity-100"
                                />
                                <img
                                    src="/images/qr2.jpg"
                                    alt=""
                                    className="border-border h-14 w-14 rounded-lg border object-cover opacity-90 group-hover:opacity-100"
                                />
                            </div>
                            <ArrowRight className="text-muted-foreground group-hover:text-primary absolute top-6 right-6 size-5 transition-colors" />
                        </Link>

                        <Link
                            href="/properties"
                            className="group border-border bg-card hover:border-primary/30 relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all hover:shadow-md"
                        >
                            <div className="bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mb-4 inline-flex rounded-xl p-3">
                                <Building2 className="size-6" strokeWidth={1.75} />
                            </div>
                            <h3 className="font-semibold">Browse properties</h3>
                            <p className="text-muted-foreground mt-1 text-sm">Latest approved listings with filters.</p>
                            <ArrowRight className="text-muted-foreground group-hover:text-primary absolute top-6 right-6 size-5 transition-colors" />
                        </Link>

                        <Link
                            href="/account/messages"
                            className="group border-border bg-card hover:border-primary/30 relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all hover:shadow-md"
                        >
                            <div className="bg-violet-500/10 text-violet-600 dark:text-violet-400 mb-4 inline-flex rounded-xl p-3">
                                <MessageCircle className="size-6" strokeWidth={1.75} />
                            </div>
                            <h3 className="font-semibold">Team chat</h3>
                            <p className="text-muted-foreground mt-1 text-sm">In-app threads with support — refresh for new replies.</p>
                            <ArrowRight className="text-muted-foreground group-hover:text-primary absolute top-6 right-6 size-5 transition-colors" />
                        </Link>

                        <a
                            href="/agent/login"
                            className="group border-border bg-card hover:border-primary/30 relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all hover:shadow-md"
                        >
                            <div className="bg-amber-500/10 text-amber-700 dark:text-amber-400 mb-4 inline-flex rounded-xl p-3">
                                <CreditCard className="size-6" strokeWidth={1.75} />
                            </div>
                            <h3 className="font-semibold">Agent dashboard</h3>
                            <p className="text-muted-foreground mt-1 text-sm">List or manage your properties.</p>
                            <ArrowRight className="text-muted-foreground group-hover:text-primary absolute top-6 right-6 size-5 transition-colors" />
                        </a>
                    </div>
                </section>

                <section className="grid gap-8 lg:grid-cols-3">
                    <Card className="border-primary/10 lg:col-span-2">
                        <CardHeader>
                            <div className="flex items-center gap-2">
                                <Search className="text-primary size-5" />
                                <div>
                                    <CardTitle>Advanced search</CardTitle>
                                    <CardDescription>
                                        Filters match the main listings page. Suggestions appear as you type.
                                    </CardDescription>
                                </div>
                            </div>
                        </CardHeader>
                        <CardContent>
                            <form action="/properties" method="get" className="space-y-5">
                                <input type="hidden" name="type" value={type === ALL ? '' : type} />
                                <input type="hidden" name="bedrooms" value={bedrooms === ALL ? '' : bedrooms} />
                                <input type="hidden" name="sort" value={sort === ALL ? '' : sort} />
                                <div className="relative" ref={suggestWrapRef}>
                                    <Label htmlFor={searchBoxId}>Keyword or area</Label>
                                    <Input
                                        id={searchBoxId}
                                        name="keyword"
                                        value={keyword}
                                        onChange={(e) => setKeyword(e.target.value)}
                                        onFocus={() => keyword.trim().length >= 2 && suggestions.length > 0 && setSuggestOpen(true)}
                                        placeholder="e.g. Budhanilkantha, land, apartment…"
                                        autoComplete="off"
                                        className="mt-1.5"
                                    />
                                    {suggestOpen && suggestions.length > 0 && (
                                        <div
                                            className="border-border bg-popover absolute z-20 mt-1 max-h-72 w-full overflow-auto rounded-xl border py-1 shadow-lg"
                                            role="listbox"
                                        >
                                            {suggestions.map((s) => (
                                                <button
                                                    key={s.id}
                                                    type="button"
                                                    role="option"
                                                    className="hover:bg-muted flex w-full flex-col gap-0.5 px-4 py-3 text-left text-sm transition-colors"
                                                    onClick={() => onPickSuggestion(s)}
                                                >
                                                    <span className="font-medium">{s.title}</span>
                                                    <span className="text-muted-foreground text-xs">
                                                        {[s.location, s.city].filter(Boolean).join(' · ')} · Rs.{' '}
                                                        {s.price.toLocaleString()} · {s.type}
                                                    </span>
                                                </button>
                                            ))}
                                        </div>
                                    )}
                                </div>
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label htmlFor="dash-city">City</Label>
                                        <Input id="dash-city" name="city" placeholder="City" className="mt-1.5" />
                                    </div>
                                    <div>
                                        <Label>Type</Label>
                                        <Select value={type} onValueChange={setType}>
                                            <SelectTrigger className="mt-1.5 w-full">
                                                <SelectValue placeholder="Type" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value={ALL}>Any type</SelectItem>
                                                <SelectItem value="sale">For sale</SelectItem>
                                                <SelectItem value="rent">For rent</SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    <div>
                                        <Label>Bedrooms</Label>
                                        <Select value={bedrooms} onValueChange={setBedrooms}>
                                            <SelectTrigger className="mt-1.5 w-full">
                                                <SelectValue placeholder="Beds" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value={ALL}>Any beds</SelectItem>
                                                <SelectItem value="1">1</SelectItem>
                                                <SelectItem value="2">2</SelectItem>
                                                <SelectItem value="3">3</SelectItem>
                                                <SelectItem value="4">4+</SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    <div>
                                        <Label>Sort by price</Label>
                                        <Select value={sort} onValueChange={setSort}>
                                            <SelectTrigger className="mt-1.5 w-full">
                                                <SelectValue placeholder="Sort" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value={ALL}>Default</SelectItem>
                                                <SelectItem value="low_high">Low → high</SelectItem>
                                                <SelectItem value="high_low">High → low</SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    <div>
                                        <Label htmlFor="dash-min">Min price (Rs.)</Label>
                                        <Input id="dash-min" name="min_price" type="number" className="mt-1.5" placeholder="0" />
                                    </div>
                                    <div>
                                        <Label htmlFor="dash-max">Max price (Rs.)</Label>
                                        <Input id="dash-max" name="max_price" type="number" className="mt-1.5" placeholder="Any" />
                                    </div>
                                </div>
                                <div className="flex flex-wrap gap-3">
                                    <Button type="submit">Search listings</Button>
                                    <Button type="button" variant="secondary" asChild>
                                        <a href="/properties">View all</a>
                                    </Button>
                                </div>
                            </form>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle className="text-base">Recent searches</CardTitle>
                            <CardDescription>Re-run a filter you used on the listings page.</CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-2">
                            {recentSearches.length === 0 ? (
                                <p className="text-muted-foreground text-sm">
                                    No saved searches yet. Use filters on{' '}
                                    <Link href="/properties" className="text-primary font-medium underline-offset-4 hover:underline">
                                        Properties
                                    </Link>{' '}
                                    while signed in.
                                </p>
                            ) : (
                                <ul className="space-y-2">
                                    {recentSearches.map((r) => (
                                        <li key={r.id}>
                                            <Link
                                                href={buildPropertiesUrl(r.params)}
                                                className="border-border bg-muted/40 hover:border-primary/25 hover:bg-muted/80 block rounded-xl border px-3 py-2.5 text-sm transition-colors"
                                            >
                                                <span className="line-clamp-2 font-medium">{r.label}</span>
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            )}
                        </CardContent>
                    </Card>
                </section>

                <section>
                    <div className="mb-4 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <div className="flex items-center gap-2">
                                <Sparkles className="text-primary size-5" />
                                <h2 className="text-lg font-semibold tracking-tight">Fresh listings</h2>
                            </div>
                            <p className="text-muted-foreground mt-1 text-sm">Curated from the newest approved properties.</p>
                        </div>
                        <Button variant="outline" asChild>
                            <Link href="/properties">See full catalogue</Link>
                        </Button>
                    </div>
                    {spotlightProperties.length === 0 ? (
                        <p className="text-muted-foreground text-sm">No listings available right now.</p>
                    ) : (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {spotlightProperties.map((p) => (
                                <PropertyCardLink key={p.id} p={p} />
                            ))}
                        </div>
                    )}
                </section>

                <section>
                    <Card className="overflow-hidden">
                        <CardHeader className="from-primary/8 border-b bg-linear-to-r to-transparent">
                            <CardTitle className="flex items-center gap-2 text-xl">
                                <Phone className="size-5" />
                                Contact &amp; support
                            </CardTitle>
                            <CardDescription>
                                Reach us the way you prefer — we respond during business hours.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="pt-8 pb-8">
                            <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                {support.whatsapp_digits ? (
                                    <a
                                        href={waUrl(support.whatsapp_digits, waPreset)}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className={cn(
                                            'flex flex-col gap-3 rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5',
                                            'transition-all hover:border-emerald-500/40 hover:bg-emerald-500/10',
                                        )}
                                    >
                                        <span className="text-2xl" aria-hidden>
                                            💬
                                        </span>
                                        <span className="font-semibold text-emerald-800 dark:text-emerald-200">WhatsApp</span>
                                        <span className="text-muted-foreground text-xs">Fast replies on mobile</span>
                                    </a>
                                ) : null}

                                {support.messenger_url ? (
                                    <a
                                        href={support.messenger_url}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="flex flex-col gap-3 rounded-2xl border border-blue-500/20 bg-blue-500/5 p-5 transition-all hover:border-blue-500/40 hover:bg-blue-500/10"
                                    >
                                        <span className="text-2xl" aria-hidden>
                                            💙
                                        </span>
                                        <span className="font-semibold text-blue-800 dark:text-blue-200">Messenger</span>
                                        <span className="text-muted-foreground text-xs">Facebook chat</span>
                                    </a>
                                ) : null}

                                <a
                                    href={`mailto:${support.email}?subject=${encodeURIComponent('Enquiry from website dashboard')}`}
                                    className="flex flex-col gap-3 rounded-2xl border border-red-500/15 bg-red-500/5 p-5 transition-all hover:border-red-500/35 hover:bg-red-500/10"
                                >
                                    <Mail className="size-8 text-red-500" strokeWidth={1.5} />
                                    <span className="font-semibold text-red-900 dark:text-red-200">Email</span>
                                    <span className="text-muted-foreground line-clamp-2 break-all text-xs">{support.email}</span>
                                </a>

                                {support.phone_display ? (
                                    <a
                                        href={`tel:${support.phone_display.replace(/\s/g, '')}`}
                                        className="flex flex-col gap-3 rounded-2xl border border-violet-500/15 bg-violet-500/5 p-5 transition-all hover:border-violet-500/35 hover:bg-violet-500/10"
                                    >
                                        <MapPin className="size-8 text-violet-600" strokeWidth={1.5} />
                                        <span className="font-semibold text-violet-900 dark:text-violet-200">Call</span>
                                        <span className="text-muted-foreground text-xs">{support.phone_display}</span>
                                    </a>
                                ) : (
                                    <div className="border-border bg-muted/30 flex flex-col justify-center gap-2 rounded-2xl border border-dashed p-5">
                                        <Phone className="text-muted-foreground size-8" />
                                        <span className="text-muted-foreground text-sm">Phone on file in admin / company settings.</span>
                                    </div>
                                )}
                            </div>

                            <Separator className="my-8" />

                            <div className="flex flex-col items-center gap-4 text-center sm:flex-row sm:justify-center">
                                <Button asChild>
                                    <Link href="/contact?ref=dashboard">Open contact form</Link>
                                </Button>
                                <Button variant="outline" asChild>
                                    <Link href="/faqs">FAQs</Link>
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                </section>
            </div>
            </AccountShell>
        </SiteLayout>
    );
}
