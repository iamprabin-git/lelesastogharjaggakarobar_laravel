import { Link } from '@inertiajs/react';
import { PropertyCardLink } from '@/components/property-card-link';
import { Pagination, PaginationContent, PaginationItem, PaginationLink } from '@/components/ui/pagination';
import { SiteLayout } from '@/layouts/site-layout';
import type { PropertyCard } from '@/types/property';

type PaginatorLink = { url: string | null; label: string; active: boolean };

type PaginatedProperties = {
    data: PropertyCard[];
    links: PaginatorLink[];
};

export default function SoldProperties({ properties }: { properties: PaginatedProperties }) {
    return (
        <SiteLayout title="Sold properties">
            <section className="container mx-auto px-4 py-10 md:py-14">
                <div className="mb-10 max-w-2xl">
                    <h1 className="text-3xl font-bold tracking-tight md:text-4xl">Sold properties</h1>
                    <p className="text-muted-foreground mt-2">
                        Past transactions — listings are shown for reference only and do not open a full listing page.
                    </p>
                    <p className="text-muted-foreground mt-3 text-sm">
                        Looking for active listings?{' '}
                        <Link href="/properties" className="text-primary font-medium underline-offset-4 hover:underline">
                            Browse available properties
                        </Link>
                        .
                    </p>
                </div>

                <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    {properties.data.length === 0 ? (
                        <p className="text-muted-foreground col-span-full text-center py-12">No sold properties to show yet.</p>
                    ) : (
                        properties.data.map((p) => <PropertyCardLink key={p.id} p={p} href={false} />)
                    )}
                </div>

                {properties.links.length > 3 && (
                    <Pagination className="mt-10">
                        <PaginationContent>
                            {properties.links.map((link, i) => {
                                const inner = <span dangerouslySetInnerHTML={{ __html: link.label }} />;
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
