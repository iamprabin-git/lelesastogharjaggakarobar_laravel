import { Link, usePage } from '@inertiajs/react';

type Company = {
    name?: string | null;
    email?: string | null;
    phone?: string | null;
    logo?: string | null;
    address?: string | null;
    facebook?: string | null;
    instagram?: string | null;
    youtube?: string | null;
    tiktok?: string | null;
    whatsapp?: string | null;
    primary_color?: string | null;
    secondary_color?: string | null;
} | null;

export function SiteFooter() {
    const { company } = usePage<{ company: Company }>().props;
    const name = company?.name ?? 'RealEstate';
    const from = company?.primary_color ?? '#18181b';
    const to = company?.secondary_color ?? '#27272a';

    return (
        <footer
            className="mt-auto text-primary-foreground"
            style={{
                background: `linear-gradient(135deg, ${from}, ${to})`,
            }}
        >
            <div className="container mx-auto grid gap-10 px-6 py-12 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <div className="mb-4 flex items-center gap-3">
                        {company?.logo && (
                            <img src={company.logo} alt={name} className="size-14 rounded-full border-2 border-white/30 object-cover" />
                        )}
                        <h2 className="text-xl font-bold">{name}</h2>
                    </div>
                    <p className="text-sm text-white/80">
                        Trusted real estate: buying, selling, and renting with transparency.
                    </p>
                    <div className="mt-4 flex flex-wrap gap-2">
                        {company?.facebook && (
                            <a href={company.facebook} target="_blank" rel="noreferrer" className="rounded-full bg-white/10 p-2 hover:bg-white/20 transition-colors">
                                <i className="fa-brands fa-facebook-f" />
                            </a>
                        )}
                        {company?.instagram && (
                            <a href={company.instagram} target="_blank" rel="noreferrer" className="rounded-full bg-white/10 p-2 hover:bg-white/20 transition-colors">
                                <i className="fa-brands fa-instagram" />
                            </a>
                        )}
                        {company?.youtube && (
                            <a href={company.youtube} target="_blank" rel="noreferrer" className="rounded-full bg-white/10 p-2 hover:bg-white/20 transition-colors">
                                <i className="fa-brands fa-youtube" />
                            </a>
                        )}
                        {company?.tiktok && (
                            <a href={company.tiktok} target="_blank" rel="noreferrer" className="rounded-full bg-white/10 p-2 hover:bg-white/20 transition-colors">
                                <i className="fa-brands fa-tiktok" />
                            </a>
                        )}
                        {company?.whatsapp && (
                            <a href={`https://wa.me/${company.whatsapp}`} target="_blank" rel="noreferrer" className="rounded-full bg-white/10 p-2 hover:bg-white/20 transition-colors">
                                <i className="fa-brands fa-whatsapp" />
                            </a>
                        )}
                    </div>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-white/20 pb-2 font-semibold">Explore</h3>
                    <ul className="space-y-2 text-sm text-white/85">
                        <li><Link href="/" className="hover:text-white transition-colors">Home</Link></li>
                        <li><Link href="/properties" className="hover:text-white transition-colors">Properties</Link></li>
                        <li><Link href="/agent-form" className="hover:text-white transition-colors">Become an agent</Link></li>
                        <li><Link href="/about" className="hover:text-white transition-colors">About</Link></li>
                        <li><Link href="/contact" className="hover:text-white transition-colors">Contact</Link></li>
                    </ul>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-white/20 pb-2 font-semibold">More</h3>
                    <ul className="space-y-2 text-sm text-white/85">
                        <li><Link href="/faqs" className="hover:text-white transition-colors">FAQs</Link></li>
                        <li><Link href="/blogs" className="hover:text-white transition-colors">Blog</Link></li>
                        <li><Link href="/pricing" className="hover:text-white transition-colors">Pricing</Link></li>
                        <li><Link href="/privacy-policy" className="hover:text-white transition-colors">Privacy</Link></li>
                        <li><Link href="/terms" className="hover:text-white transition-colors">Terms</Link></li>
                    </ul>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-white/20 pb-2 font-semibold">Contact</h3>
                    <ul className="space-y-2 text-sm text-white/85">
                        <li className="flex gap-2">
                            <i className="fa-solid fa-location-dot mt-0.5" />
                            {company?.address ?? 'Your address'}
                        </li>
                        <li className="flex gap-2">
                            <i className="fa-solid fa-phone mt-0.5" />
                            {company?.phone ?? '+977'}
                        </li>
                        <li className="flex gap-2 break-all">
                            <i className="fa-solid fa-envelope mt-0.5" />
                            {company?.email ?? 'account@lelesastogharagga.com.np'}
                        </li>
                    </ul>
                </div>
            </div>

            <div className='flex flex-col gap-3 md:flex-row md:justify-between border-t border-white/10 py-6 px-6'>
                <div className="text-center text-sm text-white/70">
                    © {new Date().getFullYear()} {name}. All rights reserved.
                </div>
                <div className="text-center text-sm text-white/70">
                    Developed by {" "}
                    <a
                        href="https://dangolprabin.com.np"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="font-semibold hover:underline cursor-pointer"
                    >
                        Prabin Dangol
                    </a>
                </div>
            </div>
        </footer>
    );
}
