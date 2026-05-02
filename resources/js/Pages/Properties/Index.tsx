import { useState } from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Pagination, PaginationContent, PaginationItem, PaginationLink } from '@/components/ui/pagination';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { PropertyCardLink } from '@/components/property-card-link';
import { SiteLayout } from '@/layouts/site-layout';
import { sanitizeRichHtml } from '@/lib/sanitize-html';
import type { PropertyCard } from '@/types/property';

const ALL = '__all__';

type PaginatorLink = { url: string | null; label: string; active: boolean };

type PaginatedProperties = {
    data: PropertyCard[];
    links: PaginatorLink[];
};

type Filters = {
    keyword: string;
    city: string;
    type: string;
    bedrooms: string;
    min_price: string;
    max_price: string;
    sort: string;
    agent: string;
};

type FilteredAgent = { id: number; name: string } | null;

export default function PropertiesIndex({
    latestProperties,
    filters,
    filtered_agent = null,
}: {
    latestProperties: PaginatedProperties;
    filters: Filters;
    filtered_agent?: FilteredAgent;
}) {
    const f = filters;
    const [type, setType] = useState(f.type || ALL);
    const [bedrooms, setBedrooms] = useState(f.bedrooms || ALL);
    const [sort, setSort] = useState(f.sort || ALL);

    return (
        <SiteLayout title={filtered_agent ? `Properties · ${filtered_agent.name}` : 'Properties'}>
            <section className="bg-muted/40 py-10">
                <div className="container mx-auto px-4">
                    <h1 className="mb-6 text-center text-3xl font-bold tracking-tight">Properties</h1>

                    {filtered_agent ? (
                        <div className="border-primary/25 bg-primary/8 mb-6 flex flex-wrap items-center justify-between gap-3 rounded-2xl border px-4 py-3">
                            <p className="text-sm text-foreground/90">
                                Showing listings by{' '}
                                <span className="font-semibold">{filtered_agent.name}</span>.
                            </p>
                            <Button variant="outline" size="sm" asChild>
                                <Link href="/properties">Show all agents</Link>
                            </Button>
                        </div>
                    ) : null}

                    <form action="/properties" method="get" className="bg-card rounded-2xl border p-6 shadow-sm">
                        <input type="hidden" name="agent" value={f.agent} />
                        <input type="hidden" name="type" value={type === ALL ? '' : type} />
                        <input type="hidden" name="bedrooms" value={bedrooms === ALL ? '' : bedrooms} />
                        <input type="hidden" name="sort" value={sort === ALL ? '' : sort} />
                        <div className="grid gap-4 md:grid-cols-6">
                            <Input name="keyword" placeholder="Keyword" defaultValue={f.keyword} className="md:col-span-2" />
                            <Input name="city" placeholder="City" defaultValue={f.city} />
                            <div className="w-full">
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
                            <div className="w-full">
                                <Select value={bedrooms} onValueChange={setBedrooms}>
                                    <SelectTrigger className="w-full">
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
                            <Input name="min_price" type="number" placeholder="Min price" defaultValue={f.min_price} />
                            <Input name="max_price" type="number" placeholder="Max price" defaultValue={f.max_price} />
                            <div className="w-full md:col-span-2">
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
                            <Button type="submit">Apply filters</Button>
                            <Button type="button" variant="secondary" asChild>
                                <a href="/properties">Clear</a>
                            </Button>
                        </div>
                    </form>
                </div>
            </section>

            <section className="container mx-auto py-12 px-4">
                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    {latestProperties.data.length === 0 && (
                        <p className="text-muted-foreground col-span-full text-center">No properties match your filters.</p>
                    )}
                    {latestProperties.data.map((p) => (
                        <PropertyCardLink key={p.id} p={p} />
                    ))}
                </div>

                {latestProperties.links.length > 3 && (
                    <Pagination className="mt-10">
                        <PaginationContent>
                            {latestProperties.links.map((link, i) => {
                                const inner = <span dangerouslySetInnerHTML={{ __html: sanitizeRichHtml(link.label) }} />;
                                if (!link.url) {
                                    return (
                                        <PaginationItem key={i}>
                                            <span className="bg-muted text-muted-foreground flex h-9 min-w-9 items-center justify-center rounded-md px-3 text-sm">
                                                {inner}
                                            </span>
                                        </PaginationItem>
                                    );
                                }
                                return (
                                    <PaginationItem key={i}>
                                        <PaginationLink href={link.url} active={link.active}>
                                            {inner}
                                        </PaginationLink>
                                    </PaginationItem>
                                );
                            })}
                        </PaginationContent>
                    </Pagination>
                )}
            </section>
        </SiteLayout>
    );
}
