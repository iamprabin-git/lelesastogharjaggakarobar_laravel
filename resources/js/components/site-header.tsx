import { Link, usePage } from '@inertiajs/react';
import { Menu, Moon, Sun } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import { cn } from '@/lib/utils';

type Company = {
    name?: string | null;
    email?: string | null;
    phone?: string | null;
    logo?: string | null;
    facebook?: string | null;
    instagram?: string | null;
    youtube?: string | null;
    tiktok?: string | null;
    whatsapp?: string | null;
} | null;

function toggleTheme() {
    const root = document.documentElement;
    root.classList.toggle('dark');
    try {
        localStorage.setItem('re_theme', root.classList.contains('dark') ? 'dark' : 'light');
    } catch {
        /* ignore */
    }
}

const nav = [
    { href: '/', label: 'Home' },
    { href: '/properties', label: 'Properties' },
    { href: '/about', label: 'About' },
    { href: '/contact', label: 'Contact' },
    { href: '/blogs', label: 'Blog' },
    { href: '/faqs', label: 'FAQs' },
];

export function SiteHeader() {
    const { company, auth } = usePage<{ company: Company; auth: { user: { id: number } | null } }>().props;
    const name = company?.name ?? 'RealEstate';

    return (
        <header className="sticky top-0 z-50 w-full border-b border-zinc-200/70 bg-white/95 shadow-none backdrop-blur-md dark:border-zinc-800/70 dark:bg-zinc-950/95">
            <div className="hidden items-center justify-between bg-primary px-4 py-2 text-sm text-primary-foreground md:flex md:px-6">
                <div className="flex flex-wrap items-center gap-4">
                    <span>{company?.phone ?? '+977-9765726294'}</span>
                    <span className="truncate">{company?.email ?? 'info@example.com'}</span>
                </div>
                <div className="flex items-center gap-3">
                    {company?.facebook && (
                        <a href={company.facebook} target="_blank" rel="noreferrer" className="hover:opacity-80">
                            <i className="fa-brands fa-facebook" />
                        </a>
                    )}
                    {company?.instagram && (
                        <a href={company.instagram} target="_blank" rel="noreferrer" className="hover:opacity-80">
                            <i className="fa-brands fa-instagram" />
                        </a>
                    )}
                    {company?.youtube && (
                        <a href={company.youtube} target="_blank" rel="noreferrer" className="hover:opacity-80">
                            <i className="fa-brands fa-youtube" />
                        </a>
                    )}
                    <Button type="button" variant="ghost" size="icon" className="text-primary-foreground" onClick={toggleTheme}>
                        <Moon className="size-4 dark:hidden" />
                        <Sun className="hidden size-4 dark:inline" />
                    </Button>
                </div>
            </div>

            <div className="container mx-auto flex items-center justify-between gap-4 px-4 py-4">
                <Link href="/" className="flex min-w-0 items-center gap-3">
                    {company?.logo && (
                        <img src={company.logo} alt="" className="size-12 shrink-0 rounded-full border object-cover md:size-14" />
                    )}
                    <span className="truncate text-lg font-bold tracking-tight text-zinc-900 dark:text-zinc-50 md:text-xl">
                        {name}
                    </span>
                </Link>

                <nav className="hidden items-center gap-6 md:flex">
                    {nav.map((item) => (
                        <Link
                            key={item.href}
                            href={item.href}
                            className="text-sm font-medium text-zinc-600 transition-colors hover:text-primary dark:text-zinc-400 dark:hover:text-primary"
                        >
                            {item.label}
                        </Link>
                    ))}
                    {auth.user && (
                        <>
                            <Link
                                href="/dashboard"
                                className="text-sm font-medium text-zinc-600 transition-colors hover:text-primary dark:text-zinc-400 dark:hover:text-primary"
                            >
                                Dashboard
                            </Link>
                            <Link
                                href="/profile"
                                className="text-sm font-medium text-zinc-600 transition-colors hover:text-primary dark:text-zinc-400 dark:hover:text-primary"
                            >
                                Profile
                            </Link>
                        </>
                    )}
                    <Button asChild size="sm">
                        <a href="/agent/login">+ Add property</a>
                    </Button>
                </nav>

                <div className="flex items-center gap-2 md:hidden">
                    <Button type="button" variant="outline" size="icon" onClick={toggleTheme}>
                        <Moon className="size-4 dark:hidden" />
                        <Sun className="hidden size-4 dark:inline" />
                    </Button>
                    <Sheet>
                        <SheetTrigger asChild>
                            <Button variant="outline" size="icon" aria-label="Menu">
                                <Menu className="size-5" />
                            </Button>
                        </SheetTrigger>
                        <SheetContent side="right" className="w-[280px]">
                            <SheetHeader>
                                <SheetTitle>Menu</SheetTitle>
                            </SheetHeader>
                            <nav className="mt-6 flex flex-col gap-1 px-2">
                                {nav.map((item) => (
                                    <Link
                                        key={item.href}
                                        href={item.href}
                                        className={cn(
                                            'rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70',
                                        )}
                                    >
                                        {item.label}
                                    </Link>
                                ))}
                                {auth.user && (
                                    <>
                                        <Link
                                            href="/dashboard"
                                            className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                        >
                                            Dashboard
                                        </Link>
                                        <Link
                                            href="/profile"
                                            className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                        >
                                            Profile
                                        </Link>
                                    </>
                                )}
                                <Button asChild className="mt-4">
                                    <a href="/agent/login">+ Add property</a>
                                </Button>
                            </nav>
                        </SheetContent>
                    </Sheet>
                </div>
            </div>
        </header>
    );
}
