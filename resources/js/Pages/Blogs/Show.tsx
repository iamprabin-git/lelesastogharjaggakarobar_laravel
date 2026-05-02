import { Link } from '@inertiajs/react';
import { Card, CardContent } from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { PropertyCardLink } from '@/components/property-card-link';
import { SiteLayout } from '@/layouts/site-layout';
import { sanitizeRichHtml } from '@/lib/sanitize-html';
import type { PropertyCard } from '@/types/property';

type BlogDetail = {
    id: number;
    title: string;
    slug: string;
    author: string | null;
    content: string;
    image: string | null;
    created_at: string | null;
};

type RelatedBlog = {
    id: number;
    title: string;
    slug: string;
    excerpt: string | null;
    image: string | null;
};

export default function BlogShow({
    blog,
    relatedBlogs,
    latestProperties,
}: {
    blog: BlogDetail;
    relatedBlogs: RelatedBlog[];
    latestProperties: PropertyCard[];
}) {
    const dateStr = blog.created_at ? new Date(blog.created_at).toLocaleDateString() : '';
    const contentSafe = sanitizeRichHtml(blog.content);

    return (
        <SiteLayout title={blog.title}>
            <article className="container mx-auto px-4 py-12">
                {blog.image && (
                    <div className="relative mx-auto mb-8 aspect-video max-h-[360px] w-full max-w-5xl overflow-hidden rounded-2xl border sm:mb-10 sm:aspect-[21/9] sm:max-h-none">
                        <img src={blog.image} alt="" className="h-full w-full object-cover" />
                    </div>
                )}
                <div className="mx-auto max-w-3xl">
                    <h1 className="text-3xl font-bold tracking-tight md:text-4xl">{blog.title}</h1>
                    <p className="text-muted-foreground mt-3 text-sm">
                        {blog.author && <span>By {blog.author}</span>}
                        {blog.author && dateStr && ' · '}
                        {dateStr}
                    </p>
                    <Separator className="my-8" />
                    <div
                        className="prose-article mt-10 space-y-4 text-sm leading-relaxed [&_img]:max-w-full [&_h2]:mt-8 [&_h2]:text-xl [&_h2]:font-semibold [&_h3]:mt-6 [&_p]:text-muted-foreground [&_ul]:my-4 [&_ul]:list-inside [&_ul]:list-disc"
                        dangerouslySetInnerHTML={{ __html: contentSafe }}
                    />
                </div>

                {relatedBlogs.length > 0 && (
                    <section className="mx-auto mt-16 max-w-5xl">
                        <h2 className="mb-6 text-xl font-semibold">Related posts</h2>
                        <div className="grid gap-6 sm:grid-cols-2">
                            {relatedBlogs.map((r) => (
                                <Link key={r.id} href={`/blogs/${r.slug}`} className="block transition-shadow hover:shadow-md">
                                    <Card className="gap-0 p-0 py-0">
                                        <CardContent className="flex gap-4 p-3">
                                            {r.image && (
                                                <img src={r.image} alt="" className="size-24 shrink-0 rounded-lg object-cover" />
                                            )}
                                            <div className="min-w-0">
                                                <h3 className="line-clamp-2 font-medium">{r.title}</h3>
                                                {r.excerpt && (
                                                    <p className="text-muted-foreground mt-1 line-clamp-2 text-xs">{r.excerpt}</p>
                                                )}
                                            </div>
                                        </CardContent>
                                    </Card>
                                </Link>
                            ))}
                        </div>
                    </section>
                )}

                {latestProperties.length > 0 && (
                    <section className="mx-auto mt-16 max-w-5xl">
                        <h2 className="mb-6 text-xl font-semibold">Latest properties</h2>
                        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            {latestProperties.map((p) => (
                                <PropertyCardLink key={p.id} p={p} />
                            ))}
                        </div>
                    </section>
                )}
            </article>
        </SiteLayout>
    );
}
