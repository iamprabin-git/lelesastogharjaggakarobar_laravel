import type { LucideIcon } from 'lucide-react';
import {
    Banknote,
    Briefcase,
    Building2,
    CircleHelp,
    ExternalLink,
    Facebook,
    Handshake,
    Home,
    Instagram,
    LineChart,
    Linkedin,
    Mail,
    MapPinned,
    Megaphone,
    Phone,
    Scale,
    ShieldCheck,
    UserSearch,
} from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { SiteLayout } from '@/layouts/site-layout';
import { sanitizeRichHtml } from '@/lib/sanitize-html';
import { cn } from '@/lib/utils';
import type { AboutPayload, AboutServiceItem, TeamMemberPublic } from '@/types/about';

const SERVICE_ICONS: Record<string, LucideIcon> = {
    Banknote,
    Megaphone,
    Scale,
    UserSearch,
    LineChart,
    MapPinned,
    Briefcase,
    Handshake,
    Home,
    ShieldCheck,
    Building2,
    CircleHelp,
};

function ServiceIcon({ name }: { name: string }) {
    const Icon = SERVICE_ICONS[name] ?? CircleHelp;
    return <Icon className="size-6 shrink-0" aria-hidden />;
}

function resolveSocialHref(
    platform: 'facebook' | 'linkedin' | 'instagram' | 'tiktok' | 'whatsapp',
    raw: string | null,
): string | null {
    if (!raw?.trim()) {
        return null;
    }
    const v = raw.trim();
    if (v.startsWith('http://') || v.startsWith('https://')) {
        return v;
    }
    if (platform === 'whatsapp') {
        const digits = v.replace(/\D/g, '');
        return digits ? `https://wa.me/${digits}` : null;
    }
    if (platform === 'tiktok') {
        const handle = v.replace(/^@/, '');
        return handle ? `https://www.tiktok.com/@${handle}` : null;
    }
    return `https://${v}`;
}

function mailHref(email: string | null): string | null {
    if (!email?.trim()) {
        return null;
    }
    return `mailto:${email.trim()}`;
}

function telHref(phone: string | null): string | null {
    if (!phone?.trim()) {
        return null;
    }
    const normalized = phone.trim().replace(/[^\d+]/g, '');
    return normalized ? `tel:${normalized}` : null;
}

function buildSocialLinks(member: TeamMemberPublic): { label: string; href: string; Icon: LucideIcon }[] {
    const items: { label: string; href: string; Icon: LucideIcon }[] = [];

    const li = resolveSocialHref('linkedin', member.linkedin);
    if (li) {
        items.push({ label: 'LinkedIn', href: li, Icon: Linkedin });
    }
    const fb = resolveSocialHref('facebook', member.facebook);
    if (fb) {
        items.push({ label: 'Facebook', href: fb, Icon: Facebook });
    }
    const ig = resolveSocialHref('instagram', member.instagram);
    if (ig) {
        items.push({ label: 'Instagram', href: ig, Icon: Instagram });
    }
    const tt = resolveSocialHref('tiktok', member.tiktok);
    if (tt) {
        items.push({ label: 'TikTok', href: tt, Icon: ExternalLink });
    }
    const wa = resolveSocialHref('whatsapp', member.whatsapp);
    if (wa) {
        items.push({ label: 'WhatsApp', href: wa, Icon: Phone });
    }

    return items;
}

function MemberAvatar({
    name,
    photo,
    shape = 'square',
    className,
}: {
    name: string;
    photo: string | null;
    shape?: 'square' | 'circle';
    className?: string;
}) {
    const initials = name
        .split(/\s+/)
        .filter(Boolean)
        .map((w) => w[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();

    const round = shape === 'circle' ? 'rounded-full' : 'rounded-2xl';

    if (photo) {
        return (
            <img
                src={photo}
                alt={name}
                className={cn('h-full w-full object-cover shadow-inner', round, className)}
            />
        );
    }

    return (
        <div
            className={cn(
                'bg-primary/15 text-primary flex h-full w-full items-center justify-center text-2xl font-bold tracking-tight ring-1 ring-primary/25',
                round,
                className,
            )}
        >
            {initials || '?'}
        </div>
    );
}

function TeamMemberContactDetails({
    member,
    variant,
}: {
    member: TeamMemberPublic;
    variant: 'light' | 'on-primary';
}) {
    const mail = mailHref(member.email);
    const tel = telHref(member.phone);
    const socials = buildSocialLinks(member);

    const row =
        variant === 'on-primary'
            ? 'border-white/15 bg-white/10 text-primary-foreground hover:bg-white/18'
            : 'border-border/70 bg-muted/70 text-foreground hover:bg-muted';

    const emptyMuted =
        variant === 'on-primary' ? 'text-primary-foreground/75 text-sm' : 'text-muted-foreground text-sm';

    return (
        <div className="flex flex-col gap-2.5">
            {mail ? (
                <a
                    href={mail}
                    className={cn('flex items-center gap-3 rounded-xl border px-3 py-2.5 text-sm transition-colors', row)}
                >
                    <Mail className="size-4 shrink-0 opacity-90" aria-hidden />
                    <span className="min-w-0 truncate">{member.email}</span>
                </a>
            ) : null}
            {tel ? (
                <a
                    href={tel}
                    className={cn('flex items-center gap-3 rounded-xl border px-3 py-2.5 text-sm transition-colors', row)}
                >
                    <Phone className="size-4 shrink-0 opacity-90" aria-hidden />
                    <span className="min-w-0 truncate">{member.phone}</span>
                </a>
            ) : null}
            {socials.length > 0 ? (
                <div className="grid gap-2 sm:grid-cols-2">
                    {socials.map(({ label, href, Icon }) => (
                        <a
                            key={label}
                            href={href}
                            target="_blank"
                            rel="noopener noreferrer"
                            className={cn(
                                'flex items-center gap-2 rounded-xl border px-3 py-2.5 text-sm transition-colors',
                                row,
                            )}
                        >
                            <Icon className="size-4 shrink-0 opacity-90" aria-hidden />
                            <span className="truncate">{label}</span>
                        </a>
                    ))}
                </div>
            ) : null}
            {!mail && !tel && socials.length === 0 ? <p className={emptyMuted}>Contact details coming soon.</p> : null}
        </div>
    );
}

function TeamMemberFront({ member, hint }: { member: TeamMemberPublic; hint: 'hover' | 'tap' }) {
    return (
        <div className="relative flex h-full min-h-0 flex-col px-6 pb-7 pt-9 text-center">
            <div className="relative mx-auto mb-6 shrink-0">
                <div
                    className="from-primary/30 to-primary/5 absolute inset-[-10px] rounded-full bg-gradient-to-br opacity-90 blur-md dark:opacity-70"
                    aria-hidden
                />
                <div className="relative mx-auto size-[156px] overflow-hidden rounded-full shadow-xl ring-[5px] ring-background dark:ring-background">
                    <MemberAvatar name={member.name} photo={member.photo} shape="circle" />
                </div>
            </div>
            <h3 className="text-xl font-bold tracking-tight">{member.name}</h3>
            <p className="text-primary mt-1.5 text-sm font-semibold">{member.position}</p>
            {member.bio ? (
                <p className="text-muted-foreground mt-4 line-clamp-[6] text-sm leading-relaxed">{member.bio}</p>
            ) : (
                <p className="text-muted-foreground mt-4 text-sm italic opacity-75">Committed to transparent deals.</p>
            )}
            <div className="mt-auto pt-8">
                <span className="text-muted-foreground inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.22em]">
                    <span className="bg-primary/80 size-1.5 shrink-0 rounded-full" aria-hidden />
                    {hint === 'hover' ? 'Hover to connect' : 'Contact below'}
                </span>
            </div>
        </div>
    );
}

function TeamMemberFlipCard({ member }: { member: TeamMemberPublic }) {
    return (
        <>
            <div className="border-border/60 bg-card md:hidden overflow-hidden rounded-2xl border shadow-[0_12px_40px_-16px_rgba(0,0,0,0.25)] ring-1 ring-black/[0.04] dark:shadow-[0_12px_40px_-16px_rgba(0,0,0,0.55)] dark:ring-white/[0.06]">
                <TeamMemberFront member={member} hint="tap" />
                <div className="border-border/60 from-muted/55 border-t bg-gradient-to-b to-background px-5 pb-6 pt-5">
                    <p className="text-muted-foreground mb-3 text-[11px] font-bold uppercase tracking-[0.2em]">
                        Contact & social
                    </p>
                    <TeamMemberContactDetails member={member} variant="light" />
                </div>
            </div>

            <div className="group/parent relative hidden aspect-[7/10] max-h-[520px] min-h-[440px] w-full md:block [perspective:1400px]">
                <div className="relative h-full w-full [transform-style:preserve-3d] motion-safe:transition-transform motion-safe:duration-[720ms] motion-safe:ease-[cubic-bezier(0.22,1,0.36,1)] motion-safe:group-hover/parent:[transform:rotateY(180deg)]">
                    <div className="absolute inset-0 overflow-hidden rounded-2xl border border-black/[0.06] bg-gradient-to-br from-card via-card to-primary/[0.06] shadow-[0_20px_50px_-24px_rgba(0,0,0,0.35)] [backface-visibility:hidden] ring-1 ring-black/[0.04] dark:border-white/[0.08] dark:from-card dark:via-card dark:to-primary/[0.12] dark:ring-white/[0.06]">
                        <TeamMemberFront member={member} hint="hover" />
                    </div>

                    <div className="absolute inset-0 flex flex-col overflow-hidden rounded-2xl border border-white/15 bg-gradient-to-br from-primary via-primary to-primary/75 p-6 text-primary-foreground shadow-[0_24px_56px_-20px_rgba(0,0,0,0.45)] [backface-visibility:hidden] [transform:rotateY(180deg)] dark:border-white/10 dark:shadow-black/40">
                        <div>
                            <p className="text-primary-foreground/85 text-[11px] font-bold uppercase tracking-[0.24em]">
                                Get in touch
                            </p>
                            <h3 className="mt-2 text-xl font-bold leading-tight">{member.name}</h3>
                            <p className="text-primary-foreground/90 mt-1 text-sm font-medium">{member.position}</p>
                        </div>
                        <div className="border-white/15 mt-5 flex min-h-0 flex-1 flex-col border-t pt-5">
                            <p className="text-primary-foreground/80 mb-3 text-xs font-semibold uppercase tracking-wide">
                                Contact & profiles
                            </p>
                            <div className="min-h-0 flex-1 overflow-y-auto pr-1 [-webkit-overflow-scrolling:touch]">
                                <TeamMemberContactDetails member={member} variant="on-primary" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default function About({
    about,
    services,
    teamMembers,
}: {
    about: AboutPayload;
    services: AboutServiceItem[];
    teamMembers: TeamMemberPublic[];
}) {
    const heroHasPhoto = Boolean(about.hero_image);

    return (
        <SiteLayout title="About">
            <section className="relative isolate overflow-hidden">
                <div className="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_120%_80%_at_50%_-20%,hsl(var(--primary)/0.22),transparent_55%),linear-gradient(to_bottom,hsl(var(--muted)),hsl(var(--background)))]" />
                {heroHasPhoto ? (
                    <>
                        <img src={about.hero_image!} alt="" className="absolute inset-0 -z-10 h-full w-full object-cover" />
                        <div className="absolute inset-0 -z-10 bg-gradient-to-t from-background via-background/75 to-black/55" />
                    </>
                ) : null}

                <div className="container mx-auto px-4 pb-28 pt-20 md:pb-36 md:pt-28">
                    <p className="text-primary mb-3 text-center text-xs font-semibold uppercase tracking-[0.2em]">About us</p>
                    <h1 className="mx-auto max-w-4xl text-center text-4xl font-bold tracking-tight md:text-5xl lg:text-[3.25rem] lg:leading-[1.1]">
                        {about.hero_title}
                    </h1>
                    {about.hero_description ? (
                        <p
                            className={`mx-auto mt-6 max-w-2xl text-center text-lg leading-relaxed ${heroHasPhoto ? 'text-white/90 drop-shadow-sm md:text-xl' : 'text-muted-foreground'}`}
                        >
                            {about.hero_description}
                        </p>
                    ) : null}
                </div>

                <div className="relative z-10 container mx-auto -mt-16 max-w-5xl px-4 pb-16 md:-mt-20">
                    <div className="bg-card/95 supports-[backdrop-filter]:bg-card/85 rounded-2xl border shadow-xl backdrop-blur-md">
                        <div className="divide-border grid divide-y md:grid-cols-3 md:divide-x md:divide-y-0">
                            <div className="flex flex-col items-center gap-1 px-6 py-6 text-center">
                                <span className="text-muted-foreground text-xs font-semibold uppercase tracking-wide">
                                    Properties sold
                                </span>
                                <span className="text-primary text-3xl font-bold tabular-nums md:text-4xl">
                                    {about.properties_sold}+
                                </span>
                            </div>
                            <div className="flex flex-col items-center gap-1 px-6 py-6 text-center">
                                <span className="text-muted-foreground text-xs font-semibold uppercase tracking-wide">
                                    Happy clients
                                </span>
                                <span className="text-primary text-3xl font-bold tabular-nums md:text-4xl">
                                    {about.happy_clients}+
                                </span>
                            </div>
                            <div className="flex flex-col items-center gap-1 px-6 py-6 text-center">
                                <span className="text-muted-foreground text-xs font-semibold uppercase tracking-wide">
                                    Years strong
                                </span>
                                <span className="text-primary text-3xl font-bold tabular-nums md:text-4xl">
                                    {about.experience_years}+
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="border-border/60 container mx-auto border-b px-4 py-14 md:py-20 lg:py-24">
                <div className="grid items-start gap-12 lg:grid-cols-12 lg:gap-16">
                    <div className="lg:col-span-5">
                        <div className="bg-muted relative overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5 dark:ring-white/10">
                            {about.about_image ? (
                                <img
                                    src={about.about_image}
                                    alt=""
                                    className="aspect-[4/5] w-full object-cover"
                                />
                            ) : (
                                <div className="from-primary/25 via-muted flex aspect-[4/5] w-full items-end bg-gradient-to-br to-background p-8">
                                    <p className="text-muted-foreground text-sm leading-relaxed">
                                        Featured photo placeholder—add your office or team image from the admin About section.
                                    </p>
                                </div>
                            )}
                            <div className="border-background bg-primary text-primary-foreground absolute bottom-6 left-6 rounded-xl border-2 px-4 py-3 shadow-lg">
                                <p className="text-2xl font-bold tabular-nums">{about.experience_years}+</p>
                                <p className="text-xs font-medium opacity-90">Years of local expertise</p>
                            </div>
                        </div>
                    </div>

                    <div className="space-y-10 lg:col-span-7">
                        <div className="space-y-5">
                            <h2 className="text-3xl font-bold tracking-tight md:text-4xl">
                                About Lele Sasto Ghar Jagga Karobar
                            </h2>
                            <p className="text-muted-foreground leading-relaxed md:text-[17px] md:leading-relaxed">
                                Lele Sasto Ghar Jagga Karobar is a premier real estate brokerage agency dedicated to
                                providing affordable and high-quality land and housing solutions in the Lele region and
                                beyond. Guided by our core principle below, we bridge the gap between value and quality in
                                the Nepalese real estate market.
                            </p>
                            <blockquote className="border-primary bg-muted/40 rounded-r-xl border-l-4 py-4 pl-6 pr-4 italic md:text-lg [&>p]:m-0">
                                <p lang="ne" className="font-medium not-italic">
                                    “सस्तो मूल्य, भरपर्दो सेवा”
                                </p>
                                <p className="text-muted-foreground mt-2 text-base font-normal not-italic">
                                    Affordable Price, Reliable Service
                                </p>
                            </blockquote>
                            <p className="text-muted-foreground leading-relaxed md:text-[17px] md:leading-relaxed">
                                With a deep-rooted presence in the local community and a team of passionate experts, we ensure
                                every transaction is handled with maximum transparency. We simplify buying complexity and make
                                land ownership more accessible.
                            </p>
                            <p className="text-muted-foreground leading-relaxed md:text-[17px] md:leading-relaxed">
                                We focus on high-potential plots and homes with strong return on investment. Hundreds of
                                families and investors have secured their future with us—beyond showings, we offer legal
                                verification and documentation support for your peace of mind.
                            </p>
                        </div>

                        <div className="grid gap-5 sm:grid-cols-2">
                            {about.mission ? (
                                <Card className="border-border/80 shadow-sm">
                                    <CardContent className="space-y-3 p-6">
                                        <h3 className="text-lg font-semibold">Mission</h3>
                                        <div
                                            className="text-muted-foreground space-y-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline [&_img]:max-w-full"
                                            dangerouslySetInnerHTML={{ __html: sanitizeRichHtml(about.mission) }}
                                        />
                                    </CardContent>
                                </Card>
                            ) : null}
                            {about.vision ? (
                                <Card className="border-border/80 shadow-sm">
                                    <CardContent className="space-y-3 p-6">
                                        <h3 className="text-lg font-semibold">Vision</h3>
                                        <div
                                            className="text-muted-foreground space-y-2 text-sm leading-relaxed [&_a]:text-primary [&_a]:underline [&_img]:max-w-full"
                                            dangerouslySetInnerHTML={{ __html: sanitizeRichHtml(about.vision) }}
                                        />
                                    </CardContent>
                                </Card>
                            ) : null}
                        </div>
                    </div>
                </div>
            </section>

            <section className="bg-muted/35 relative overflow-hidden py-16 md:py-24">
                <div className="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-border to-transparent" />
                <div className="container mx-auto px-4">
                    <div className="mx-auto mb-12 max-w-3xl text-center md:mb-16">
                        <h2 className="text-3xl font-bold tracking-tight md:text-4xl">Our services</h2>
                        <p className="text-muted-foreground mt-4 text-[17px] leading-relaxed">
                            Local expertise and end-to-end support—tailored listings, marketing, legal guidance, and
                            negotiation—so your property journey stays clear and stress-free.
                        </p>
                    </div>

                    {services.length === 0 ? (
                        <p className="text-muted-foreground text-center text-sm">
                            No services published yet. Add entries in the admin panel to display them here.
                        </p>
                    ) : (
                        <ul className="mx-auto grid max-w-6xl gap-5 sm:grid-cols-2 xl:grid-cols-4">
                            {services.map((item) => (
                                <li key={item.id}>
                                    <Card className="border-border/70 bg-card group h-full shadow-sm transition-[border-color,box-shadow] hover:border-primary/35 hover:shadow-md">
                                        <CardContent className="flex flex-col gap-4 p-6">
                                            <span className="bg-gradient-to-br from-primary/18 to-primary/5 text-primary inline-flex size-12 items-center justify-center rounded-xl ring-1 ring-primary/15 transition-transform group-hover:scale-[1.03]">
                                                <ServiceIcon name={item.icon} />
                                            </span>
                                            <div>
                                                <h3 className="text-base font-semibold leading-snug">{item.title}</h3>
                                                <p className="text-muted-foreground mt-2 text-sm leading-relaxed">
                                                    {item.description}
                                                </p>
                                            </div>
                                        </CardContent>
                                    </Card>
                                </li>
                            ))}
                        </ul>
                    )}
                </div>
            </section>

            <section className="border-border/60 container mx-auto border-t px-4 py-16 md:py-24">
                <div className="mx-auto mb-12 max-w-3xl text-center md:mb-14">
                    <h2 className="text-3xl font-bold tracking-tight md:text-4xl">Our team</h2>
                    <p className="text-muted-foreground mt-4 text-[17px] leading-relaxed">
                        Meet the brokers and specialists guiding transparent deals across Lele and the wider region. On desktop,
                        hover a card to see contact details and social links.
                    </p>
                </div>

                {teamMembers.length === 0 ? (
                    <p className="text-muted-foreground text-center text-sm">Team profiles will appear here once published.</p>
                ) : (
                    <ul className="mx-auto grid max-w-6xl gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        {teamMembers.map((member) => (
                            <li key={member.id}>
                                <TeamMemberFlipCard member={member} />
                            </li>
                        ))}
                    </ul>
                )}
            </section>
        </SiteLayout>
    );
}
