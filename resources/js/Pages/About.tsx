import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { SiteLayout } from '@/layouts/site-layout';

type AboutPayload = {
    hero_title: string;
    hero_description: string | null;
    hero_image: string | null;
    about_image: string | null;
    experience_years: string;
    properties_sold: number;
    happy_clients: number;
    mission: string | null;
    vision: string | null;
} | null;

export default function About({ about }: { about: AboutPayload }) {
    return (
        <SiteLayout title="About">
            {!about && (
                <div className="container mx-auto px-4 py-20 text-center">
                    <p className="text-muted-foreground">About content is not configured yet.</p>
                    <Button asChild className="mt-6">
                        <Link href="/">Home</Link>
                    </Button>
                </div>
            )}

            {about && (
                <>
                    <section className="relative flex min-h-[280px] items-center justify-center overflow-hidden md:min-h-[360px]">
                        {about.hero_image && (
                            <img src={about.hero_image} alt="" className="absolute inset-0 h-full w-full object-cover" />
                        )}
                        <div className="from-background/90 absolute inset-0 bg-gradient-to-t to-transparent" />
                        <div className="relative z-10 container mx-auto px-4 py-16 text-center">
                            <h1 className="text-3xl font-bold tracking-tight md:text-5xl">{about.hero_title}</h1>
                            {about.hero_description && (
                                <p className="text-muted-foreground mx-auto mt-4 max-w-2xl">{about.hero_description}</p>
                            )}
                        </div>
                    </section>

                    <section className="container mx-auto grid items-center gap-12 px-4 py-16 md:grid-cols-2">
                        {about.about_image && (
                            <img src={about.about_image} alt="" className="h-80 w-full rounded-3xl object-cover shadow-xl md:h-[28rem]" />
                        )}
                        <div>
                            <div className="mb-8 grid grid-cols-3 gap-4">
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.properties_sold}+</p>
                                        <p className="text-muted-foreground text-xs">Sold</p>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.happy_clients}+</p>
                                        <p className="text-muted-foreground text-xs">Clients</p>
                                    </CardContent>
                                </Card>
                                <Card>
                                    <CardContent className="pt-6 text-center">
                                        <p className="text-primary text-2xl font-bold">{about.experience_years}+</p>
                                        <p className="text-muted-foreground text-xs">Years</p>
                                    </CardContent>
                                </Card>
                            </div>
                            {about.mission && (
                                <div className="mb-8">
                                    <h2 className="mb-2 text-xl font-semibold">Mission</h2>
                                    <div
                                        className="text-muted-foreground space-y-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline"
                                        dangerouslySetInnerHTML={{ __html: about.mission }}
                                    />
                                </div>
                            )}
                            {about.vision && (
                                <div>
                                    <h2 className="mb-2 text-xl font-semibold">Vision</h2>
                                    <div
                                        className="text-muted-foreground space-y-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline"
                                        dangerouslySetInnerHTML={{ __html: about.vision }}
                                    />
                                </div>
                            )}
                        </div>
                    </section>
                </>
            )}
        </SiteLayout>
    );
}
