import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { SiteLayout } from '@/layouts/site-layout';

export default function LegalPage({ title, html }: { title: string; html: string }) {
    return (
        <SiteLayout title={title}>
            <section className="bg-muted/30 py-16">
                <div className="container mx-auto max-w-4xl px-4">
                    <Card>
                        <CardHeader className="text-center">
                            <CardTitle className="text-3xl font-bold tracking-tight md:text-4xl">{title}</CardTitle>
                        </CardHeader>
                        <Separator />
                        <CardContent>
                            <div
                                className="prose-legal text-foreground max-w-none space-y-4 pt-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline [&_h2]:mt-6 [&_h2]:text-lg [&_h2]:font-semibold [&_img]:max-w-full [&_ul]:list-inside [&_ul]:list-disc"
                                dangerouslySetInnerHTML={{ __html: html }}
                            />
                        </CardContent>
                    </Card>
                </div>
            </section>
        </SiteLayout>
    );
}
