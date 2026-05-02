import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { SiteLayout } from '@/layouts/site-layout';
import { sanitizeRichHtml } from '@/lib/sanitize-html';

export default function LegalPage({ title, html }: { title: string; html: string }) {
    const safe = sanitizeRichHtml(html);

    return (
        <SiteLayout title={title}>
            <section className="bg-muted/30 py-12 sm:py-16">
                <div className="container mx-auto max-w-4xl px-3 sm:px-4">
                    <Card>
                        <CardHeader className="px-4 pt-6 text-center sm:px-6">
                            <CardTitle className="break-words text-2xl font-bold tracking-tight sm:text-3xl md:text-4xl">{title}</CardTitle>
                        </CardHeader>
                        <Separator />
                        <CardContent className="px-4 pb-6 sm:px-6">
                            <div
                                className="prose-legal text-foreground max-w-none space-y-4 pt-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline [&_h2]:mt-6 [&_h2]:text-lg [&_h2]:font-semibold [&_img]:max-w-full [&_ul]:list-inside [&_ul]:list-disc"
                                dangerouslySetInnerHTML={{ __html: safe }}
                            />
                        </CardContent>
                    </Card>
                </div>
            </section>
        </SiteLayout>
    );
}
