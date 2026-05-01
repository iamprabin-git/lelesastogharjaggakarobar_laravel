import { Link } from '@inertiajs/react';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent } from '@/components/ui/card';
import { cn } from '@/lib/utils';
import type { PropertyCard } from '@/types/property';

export function PropertyCardLink({ p, href }: { p: PropertyCard; href?: string | false }) {
    const targetHref = href === false ? null : (href ?? `/properties/${p.id}`);
    const interactive = targetHref !== null;

    const card = (
        <Card
            className={cn(
                'h-full gap-0 overflow-hidden rounded-3xl p-0 py-0',
                interactive && 'transition-shadow hover:shadow-lg',
            )}
        >
            <div className="relative aspect-[4/3] overflow-hidden">
                {p.image ? (
                    <img
                        src={p.image}
                        alt=""
                        className={cn(
                            'h-full w-full object-cover',
                            interactive && 'transition duration-500 group-hover:scale-105',
                        )}
                    />
                ) : (
                    <div className="bg-muted text-muted-foreground flex h-full items-center justify-center">No image</div>
                )}
                {p.is_featured && <Badge className="absolute top-3 left-0 rounded-l-none">Featured</Badge>}
                <Badge variant="secondary" className="absolute top-3 right-3 capitalize">
                    {p.type}
                </Badge>
                <Badge className="absolute bottom-3 left-3 capitalize">{p.availability}</Badge>
            </div>
            <CardContent className="p-5 pt-5">
                <h3 className="mb-2 line-clamp-2 text-lg font-semibold">{p.title}</h3>
                <div className="text-muted-foreground flex justify-between text-sm">
                    <span>{p.location ?? p.city}</span>
                    <span className="text-primary font-bold">Rs. {p.price.toLocaleString()}</span>
                </div>
                <div className="text-muted-foreground mt-2 flex gap-4 text-sm">
                    <span>{p.bedrooms ?? 0} beds</span>
                    <span>{p.bathrooms ?? 0} baths</span>
                    <span>{p.area ?? 0} sq.ft</span>
                </div>
                {p.agent && <p className="text-muted-foreground mt-2 text-sm">Agent: {p.agent.name}</p>}
            </CardContent>
        </Card>
    );

    if (!interactive) {
        return (
            <article className="block" aria-label={p.title}>
                {card}
            </article>
        );
    }

    return (
        <Link href={targetHref} className="group block">
            {card}
        </Link>
    );
}
