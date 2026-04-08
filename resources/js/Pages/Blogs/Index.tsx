import { Link } from '@inertiajs/react';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { Pagination, PaginationContent, PaginationItem, PaginationLink } from '@/components/ui/pagination';
import { SiteLayout } from '@/layouts/site-layout';

type BlogRow = {
    id: number;
    title: string;
    slug: string;
    author: string | null;
    excerpt: string | null;
    image: string | null;
    created_at: string | null;
};

type PaginatorLink = { url: string | null; label: string; active: boolean };

type PaginatedBlogs = {
    data: BlogRow[];
    links: PaginatorLink[];
};

export default function BlogsIndex({ blogs }: { blogs: PaginatedBlogs }) {
    return (
        <SiteLayout title="Blog">
            <section className="container mx-auto px-4 py-16">
                <h1 className="mb-10 text-center text-3xl font-bold">Blog</h1>
                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    {blogs.data.length === 0 && <p className="text-muted-foreground col-span-full text-center">No posts yet.</p>}
                    {blogs.data.map((b) => (
                        <Link key={b.id} href={`/blogs/${b.slug}`} className="group block h-full">
                            <Card className="flex h-full flex-col gap-0 overflow-hidden p-0 py-0 transition-shadow hover:shadow-md">
                                <div className="relative aspect-[16/10] overflow-hidden bg-muted">
                                    {b.image ? (
                                        <img
                                            src={b.image}
                                            alt=""
                                            className="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                        />
                                    ) : (
                                        <div className="text-muted-foreground flex h-full items-center justify-center text-sm">No image</div>
                                    )}
                                </div>
                                <CardContent className="flex flex-1 flex-col pt-6">
                                    {b.author && (
                                        <Badge variant="secondary" className="mb-2 w-fit">
                                            {b.author}
                                        </Badge>
                                    )}
                                    <h2 className="line-clamp-2 text-lg font-semibold">{b.title}</h2>
                                    {b.excerpt && (
                                        <p className="text-muted-foreground mt-2 line-clamp-3 flex-1 text-sm">{b.excerpt}</p>
                                    )}
                                </CardContent>
                                <CardFooter className="pt-0">
                                    <span className="text-primary text-sm font-medium">Read more →</span>
                                </CardFooter>
                            </Card>
                        </Link>
                    ))}
                </div>

                {blogs.links.length > 3 && (
                    <Pagination className="mt-12">
                        <PaginationContent>
                            {blogs.links.map((link, i) => {
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
