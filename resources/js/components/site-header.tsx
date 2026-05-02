import { Link, router, usePage } from '@inertiajs/react';
import {
    ChevronDown,
    LayoutDashboard,
    LogOut,
    Mail,
    Menu,
    MessageCircle,
    Moon,
    Phone,
    Sun,
    UserCircle,
} from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Sheet, SheetClose, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
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

type SessionPerson = {
    id: number;
    name: string;
    email: string;
    avatar_url: string | null;
};

function toggleTheme() {
    const root = document.documentElement;
    root.classList.toggle('dark');
    try {
        localStorage.setItem('re_theme', root.classList.contains('dark') ? 'dark' : 'light');
    } catch {
        /* ignore */
    }
}

function initialsFromName(name: string): string {
    const parts = name.trim().split(/\s+/).filter(Boolean);
    if (parts.length === 0) {
        return '?';
    }
    if (parts.length === 1) {
        return parts[0].slice(0, 2).toUpperCase();
    }

    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
}

function UserAvatarThumb({ name, src, className }: { name: string; src: string | null; className?: string }) {
    if (src) {
        return <img src={src} alt="" className={cn('rounded-full object-cover', className)} />;
    }

    return (
        <span
            className={cn(
                'bg-primary/15 text-primary flex items-center justify-center rounded-full text-xs font-semibold',
                className,
            )}
            aria-hidden
        >
            {initialsFromName(name)}
        </span>
    );
}

const nav = [
    { href: '/', label: 'Home' },
    { href: '/properties', label: 'Properties' },
    { href: '/contact', label: 'Contact' },
    { href: '/blogs', label: 'Blog' },
];

const moreNav = [
    { href: '/faqs', label: 'FAQs' },
    { href: '/pricing', label: 'Pricing' },
    { href: '/spotlight/agent-of-the-month', label: 'Agent of the month' },
    { href: '/spotlight/buyer-of-the-month', label: 'Buyer of the month' },
    { href: '/privacy-policy', label: 'Privacy' },
    { href: '/terms', label: 'Terms' },
];

type SessionKind = 'user' | 'agent' | 'admin';

export function SiteHeader() {
    const { company, auth } = usePage<{
        company: Company;
        auth: {
            user: SessionPerson | null;
            agent: SessionPerson | null;
            admin: SessionPerson | null;
            unread_messages_count?: number;
        };
    }>().props;

    const unread = auth.unread_messages_count ?? 0;
    const name = company?.name ?? 'RealEstate';

    const session:
        | { kind: SessionKind; id: number; name: string; email: string; avatar_url: string | null }
        | null = auth.user
        ? { kind: 'user', ...auth.user }
        : auth.agent
          ? { kind: 'agent', ...auth.agent }
          : auth.admin
            ? { kind: 'admin', ...auth.admin }
            : null;

    const addPropertyHref = auth.agent ? '/agent' : '/agent/login';

    function ProfileDropdown({ alignEnd }: { alignEnd?: boolean }) {
        if (!session) {
            return null;
        }

        const label =
            session.kind === 'user' ? 'Member account' : session.kind === 'agent' ? 'Agent account' : 'Admin account';

        return (
            <DropdownMenu>
                <DropdownMenuTrigger asChild>
                    <Button
                        variant="outline"
                        size="icon"
                        className="size-10 shrink-0 overflow-hidden rounded-full p-0"
                        aria-label={`Open account menu (${session.name})`}
                    >
                        <UserAvatarThumb name={session.name} src={session.avatar_url} className="size-10 border-0" />
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align={alignEnd ? 'end' : 'start'} className="w-56">
                    <DropdownMenuLabel className="font-normal">
                        <div className="flex flex-col gap-0.5">
                            <span className="text-muted-foreground text-xs">{label}</span>
                            <span className="truncate font-medium">{session.name}</span>
                            <span className="text-muted-foreground truncate text-xs">{session.email}</span>
                        </div>
                    </DropdownMenuLabel>
                    <DropdownMenuSeparator />
                    {session.kind === 'user' ? (
                        <>
                            <DropdownMenuItem asChild>
                                <Link href="/account" className="cursor-pointer">
                                    <LayoutDashboard className="size-4" />
                                    Dashboard
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="/account/messages" className="cursor-pointer">
                                    <MessageCircle className="size-4" />
                                    Messages
                                    {unread > 0 ? (
                                        <Badge className="ml-auto h-5 min-w-5 rounded-full px-1 text-[10px]">{unread > 9 ? '9+' : unread}</Badge>
                                    ) : null}
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link href="/account/profile" className="cursor-pointer">
                                    <UserCircle className="size-4" />
                                    Profile & password
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem
                                variant="destructive"
                                onSelect={(e) => {
                                    e.preventDefault();
                                    router.post('/logout');
                                }}
                            >
                                <LogOut className="size-4" />
                                Log out
                            </DropdownMenuItem>
                        </>
                    ) : null}
                    {session.kind === 'agent' ? (
                        <>
                            <DropdownMenuItem asChild>
                                <a href="/agent" className="cursor-pointer">
                                    <LayoutDashboard className="size-4" />
                                    Agent dashboard
                                </a>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <a href="/agent" className="cursor-pointer">
                                    <UserCircle className="size-4" />
                                    Profile & password (panel menu)
                                </a>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem
                                variant="destructive"
                                onSelect={(e) => {
                                    e.preventDefault();
                                    router.post('/staff/agent/logout');
                                }}
                            >
                                <LogOut className="size-4" />
                                Log out
                            </DropdownMenuItem>
                        </>
                    ) : null}
                    {session.kind === 'admin' ? (
                        <>
                            <DropdownMenuItem asChild>
                                <a href="/admin" className="cursor-pointer">
                                    <LayoutDashboard className="size-4" />
                                    Admin dashboard
                                </a>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <a href="/admin" className="cursor-pointer">
                                    <UserCircle className="size-4" />
                                    Profile & password (panel menu)
                                </a>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem
                                variant="destructive"
                                onSelect={(e) => {
                                    e.preventDefault();
                                    router.post('/staff/admin/logout');
                                }}
                            >
                                <LogOut className="size-4" />
                                Log out
                            </DropdownMenuItem>
                        </>
                    ) : null}
                </DropdownMenuContent>
            </DropdownMenu>
        );
    }

    return (
        <header className="sticky top-0 z-50 w-full border-b border-zinc-200/70 bg-white/95 shadow-none backdrop-blur-md dark:border-zinc-800/70 dark:bg-zinc-950/95">
            <div className="hidden items-center justify-between bg-primary px-4 py-2 text-sm text-primary-foreground md:flex md:px-6">
                <div className="flex flex-wrap items-center gap-x-8 gap-y-2">
                    <span className="inline-flex items-center gap-2">
                        <Phone className="size-4 shrink-0 opacity-90" aria-hidden />
                        {company?.phone ? (
                            <a
                                href={`tel:${company.phone.replace(/\s/g, '')}`}
                                className="hover:text-primary-foreground/85 underline-offset-2 hover:underline"
                            >
                                {company.phone}
                            </a>
                        ) : (
                            <span>+977-9765726294</span>
                        )}
                    </span>
                    <span className="inline-flex max-w-[min(100vw-8rem,28rem)] items-center gap-2">
                        <Mail className="size-4 shrink-0 opacity-90" aria-hidden />
                        {company?.email ? (
                            <a
                                href={`mailto:${company.email}`}
                                className="truncate hover:text-primary-foreground/85 underline-offset-2 hover:underline"
                            >
                                {company.email}
                            </a>
                        ) : (
                            <span className="truncate">info@example.com</span>
                        )}
                    </span>
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
                </div>
            </div>

            <div className="container mx-auto flex items-center justify-between gap-4 px-4 py-4">
                <Link href="/" className="flex min-w-0 items-center gap-3">
                    {company?.logo && (
                        <img src={company.logo} alt="" className="size-12 shrink-0 rounded-full border object-cover md:size-14" />
                    )}
                    <span className="truncate text-lg font-bold tracking-tight text-zinc-900 dark:text-zinc-50 md:text-xl">{name}</span>
                </Link>

                <nav className="hidden items-center gap-4 md:flex md:gap-6">
                    {nav.map((item) => (
                        <Link
                            key={item.href}
                            href={item.href}
                            className="text-sm font-medium text-zinc-600 transition-colors hover:text-primary dark:text-zinc-400 dark:hover:text-primary"
                        >
                            {item.label}
                        </Link>
                    ))}
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button
                                variant="ghost"
                                className="text-muted-foreground hover:text-primary h-9 gap-1 px-2 text-sm font-medium text-zinc-600 dark:text-zinc-400"
                            >
                                More
                                <ChevronDown className="size-4 opacity-70" aria-hidden />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="start" className="w-52">
                            <DropdownMenuLabel className="text-muted-foreground text-xs font-normal">Explore more</DropdownMenuLabel>
                            <DropdownMenuSeparator />
                            {moreNav.map((item) => (
                                <DropdownMenuItem key={item.href} asChild>
                                    <Link href={item.href} className="cursor-pointer">
                                        {item.label}
                                    </Link>
                                </DropdownMenuItem>
                            ))}
                        </DropdownMenuContent>
                    </DropdownMenu>
                    {session ? (
                        <ProfileDropdown alignEnd />
                    ) : (
                        <Link
                            href="/login"
                            className="inline-flex items-center gap-1.5 text-sm font-medium text-zinc-600 transition-colors hover:text-primary dark:text-zinc-400 dark:hover:text-primary"
                        >
                            Login
                        </Link>
                    )}
                    <Button asChild size="sm">
                        <a href={addPropertyHref}>+ Add property</a>
                    </Button>
                    <Button type="button" variant="outline" size="icon" className="shrink-0" aria-label="Toggle dark mode" onClick={toggleTheme}>
                        <Moon className="size-4 dark:hidden" />
                        <Sun className="hidden size-4 dark:inline" />
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
                        <SheetContent side="right" className="w-[min(100vw-2rem,22rem)]">
                            <SheetHeader>
                                <SheetTitle>Menu</SheetTitle>
                            </SheetHeader>
                            <nav className="mt-6 flex flex-col gap-1 px-2">
                                {nav.map((item) => (
                                    <SheetClose asChild key={item.href}>
                                        <Link
                                            href={item.href}
                                            className={cn(
                                                'rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70',
                                            )}
                                        >
                                            {item.label}
                                        </Link>
                                    </SheetClose>
                                ))}
                                <p className="text-muted-foreground px-3 pt-4 pb-1 text-xs font-semibold uppercase tracking-wide">
                                    More
                                </p>
                                {moreNav.map((item) => (
                                    <SheetClose asChild key={item.href}>
                                        <Link
                                            href={item.href}
                                            className={cn(
                                                'rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70',
                                            )}
                                        >
                                            {item.label}
                                        </Link>
                                    </SheetClose>
                                ))}
                                {session ? (
                                    <>
                                        <div className="border-border mt-4 flex justify-center border-t pt-4">
                                            <UserAvatarThumb name={session.name} src={session.avatar_url} className="size-12 border border-border" />
                                            <span className="sr-only">
                                                {session.name}, {session.email}
                                            </span>
                                        </div>
                                        {session.kind === 'user' ? (
                                            <>
                                                <SheetClose asChild>
                                                    <Link
                                                        href="/account"
                                                        className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                                    >
                                                        Dashboard
                                                    </Link>
                                                </SheetClose>
                                                <SheetClose asChild>
                                                    <Link
                                                        href="/account/messages"
                                                        className="flex items-center justify-between rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                                    >
                                                        Messages
                                                        {unread > 0 ? (
                                                            <Badge className="h-5 min-w-5 rounded-full px-1.5 text-[10px]">{unread > 9 ? '9+' : unread}</Badge>
                                                        ) : null}
                                                    </Link>
                                                </SheetClose>
                                                <SheetClose asChild>
                                                    <Link
                                                        href="/account/profile"
                                                        className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                                    >
                                                        Profile & password
                                                    </Link>
                                                </SheetClose>
                                                <Button
                                                    variant="outline"
                                                    className="mt-2 w-full justify-start text-destructive hover:text-destructive"
                                                    type="button"
                                                    onClick={() => router.post('/logout')}
                                                >
                                                    <LogOut className="size-4" />
                                                    Log out
                                                </Button>
                                            </>
                                        ) : null}
                                        {session.kind === 'agent' ? (
                                            <>
                                                <SheetClose asChild>
                                                    <a
                                                        href="/agent"
                                                        className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                                    >
                                                        Agent dashboard
                                                    </a>
                                                </SheetClose>
                                                <Button
                                                    variant="outline"
                                                    className="mt-2 w-full justify-start text-destructive hover:text-destructive"
                                                    type="button"
                                                    onClick={() => router.post('/staff/agent/logout')}
                                                >
                                                    <LogOut className="size-4" />
                                                    Log out
                                                </Button>
                                            </>
                                        ) : null}
                                        {session.kind === 'admin' ? (
                                            <>
                                                <SheetClose asChild>
                                                    <a
                                                        href="/admin"
                                                        className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                                    >
                                                        Admin dashboard
                                                    </a>
                                                </SheetClose>
                                                <Button
                                                    variant="outline"
                                                    className="mt-2 w-full justify-start text-destructive hover:text-destructive"
                                                    type="button"
                                                    onClick={() => router.post('/staff/admin/logout')}
                                                >
                                                    <LogOut className="size-4" />
                                                    Log out
                                                </Button>
                                            </>
                                        ) : null}
                                    </>
                                ) : (
                                    <SheetClose asChild>
                                        <Link
                                            href="/login"
                                            className="rounded-md px-3 py-2.5 text-sm font-medium text-zinc-700 transition-colors hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800/70"
                                        >
                                            Login
                                        </Link>
                                    </SheetClose>
                                )}
                                <SheetClose asChild>
                                    <Button asChild className="mt-4 w-full">
                                        <a href={addPropertyHref}>+ Add property</a>
                                    </Button>
                                </SheetClose>
                            </nav>
                        </SheetContent>
                    </Sheet>
                </div>
            </div>
        </header>
    );
}
