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

    return (
        <footer className="mt-auto bg-gray-300 text-black dark:bg-gray-800 dark:text-white">
            <div className="container mx-auto grid gap-10 px-6 py-12 md:grid-cols-2 lg:grid-cols-4">
                <div>
                    <div className="mb-4 flex items-center gap-3">
                        {company?.logo && (
                            <img
                                src={company.logo}
                                alt={name}
                                className="size-14 rounded-full border-2 border-black/20 object-cover dark:border-white/35"
                            />
                        )}
                        <h2 className="text-xl font-bold text-black dark:text-white">{name}</h2>
                    </div>
                    <p className="text-sm text-black/75 dark:text-white/80">
                        Trusted real estate: buying, selling, and renting with transparency.
                    </p>
                    <div className="mt-4 flex flex-wrap gap-2">
                        {company?.facebook && (
                            <a
                                href={company.facebook}
                                target="_blank"
                                rel="noreferrer"
                                className="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <i className="fa-brands fa-facebook-f" />
                            </a>
                        )}
                        {company?.instagram && (
                            <a
                                href={company.instagram}
                                target="_blank"
                                rel="noreferrer"
                                className="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <i className="fa-brands fa-instagram" />
                            </a>
                        )}
                        {company?.youtube && (
                            <a
                                href={company.youtube}
                                target="_blank"
                                rel="noreferrer"
                                className="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <i className="fa-brands fa-youtube" />
                            </a>
                        )}
                        {company?.tiktok && (
                            <a
                                href={company.tiktok}
                                target="_blank"
                                rel="noreferrer"
                                className="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <i className="fa-brands fa-tiktok" />
                            </a>
                        )}
                        {company?.whatsapp && (
                            <a
                                href={`https://wa.me/${company.whatsapp}`}
                                target="_blank"
                                rel="noreferrer"
                                className="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <i className="fa-brands fa-whatsapp" />
                            </a>
                        )}
                    </div>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-black/20 pb-2 font-semibold text-black dark:border-white/25 dark:text-white">
                        Explore
                    </h3>
                    <ul className="space-y-2 text-sm text-black/85 dark:text-white/85">
                        <li>
                            <Link href="/" className="transition-colors hover:text-black dark:hover:text-white">
                                Home
                            </Link>
                        </li>
                        <li>
                            <Link href="/properties" className="transition-colors hover:text-black dark:hover:text-white">
                                Properties
                            </Link>
                        </li>
                        <li>
                            <Link href="/sold-properties" className="transition-colors hover:text-black dark:hover:text-white">
                                Sold properties
                            </Link>
                        </li>
                        <li>
                            <Link href="/agents" className="transition-colors hover:text-black dark:hover:text-white">
                                Agent list
                            </Link>
                        </li>
                        <li>
                            <Link href="/agent-form" className="transition-colors hover:text-black dark:hover:text-white">
                                Become an agent
                            </Link>
                        </li>
                        <li>
                            <Link href="/about" className="transition-colors hover:text-black dark:hover:text-white">
                                About
                            </Link>
                        </li>
                        <li>
                            <Link href="/contact" className="transition-colors hover:text-black dark:hover:text-white">
                                Contact
                            </Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-black/20 pb-2 font-semibold text-black dark:border-white/25 dark:text-white">
                        More
                    </h3>
                    <ul className="space-y-2 text-sm text-black/85 dark:text-white/85">
                        <li>
                            <Link href="/faqs" className="transition-colors hover:text-black dark:hover:text-white">
                                FAQs
                            </Link>
                        </li>
                        <li>
                            <Link href="/blogs" className="transition-colors hover:text-black dark:hover:text-white">
                                Blog
                            </Link>
                        </li>
                        <li>
                            <Link href="/pricing" className="transition-colors hover:text-black dark:hover:text-white">
                                Pricing
                            </Link>
                        </li>
                        <li>
                            <Link href="/privacy-policy" className="transition-colors hover:text-black dark:hover:text-white">
                                Privacy
                            </Link>
                        </li>
                        <li>
                            <Link href="/terms" className="transition-colors hover:text-black dark:hover:text-white">
                                Terms
                            </Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 className="mb-4 border-b border-black/20 pb-2 font-semibold text-black dark:border-white/25 dark:text-white">
                        Contact
                    </h3>
                    <ul className="space-y-2 text-sm text-black/85 dark:text-white/85">
                        <li className="flex gap-2">
                            <i className="fa-solid fa-location-dot mt-0.5 text-black dark:text-white" aria-hidden />
                            {company?.address ?? 'Your address'}
                        </li>
                        <li className="flex gap-2">
                            <i className="fa-solid fa-phone mt-0.5 text-black dark:text-white" aria-hidden />
                            {company?.phone ?? '+977'}
                        </li>
                        <li className="flex gap-2 break-all">
                            <i className="fa-solid fa-envelope mt-0.5 text-black dark:text-white" aria-hidden />
                            {company?.email ?? 'account@lelesastogharagga.com.np'}
                        </li>
                    </ul>
                </div>
            </div>

            <div className="flex flex-col gap-3 border-t border-black/15 px-6 py-6 dark:border-white/15 md:flex-row md:justify-between">
                <div className="text-center text-sm text-black/70 dark:text-white/70">
                    © {new Date().getFullYear()} {name}. All rights reserved.
                </div>
                <div className="text-center text-sm text-black/70 dark:text-white/70">
                    Developed by{' '}
                    <a
                        href="https://dangolprabin.com.np"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="cursor-pointer font-semibold text-black underline-offset-4 hover:underline dark:text-white"
                    >
                        Prabin Dangol
                    </a>
                </div>
            </div>
        </footer>
    );
}
