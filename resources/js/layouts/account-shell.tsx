import { Link, router, usePage } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
import { useState } from 'react';
import {
    Building2,
    CircleDollarSign,
    Globe,
    LayoutDashboard,
    LogOut,
    Menu,
    MessageCircle,
    Moon,
    Search,
    SlidersHorizontal,
    Sun,
    UserCircle,
    X,
} from 'lucide-react';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils';

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

type Company = {
    name?: string | null;
    logo?: string | null;
} | null;

type RecentPropertySearch = {
    id: number;
    label: string;
    params: Record<string, string>;
};

function propertiesUrlFromParams(params: Record<string, string>): string {
    const q = new URLSearchParams(params);
    const s = q.toString();

    return s ? `/properties?${s}` : '/properties';
}

export function AccountShell({ children }: PropsWithChildren) {
    const [mobileNavOpen, setMobileNavOpen] = useState(false);
    const [headerKeyword, setHeaderKeyword] = useState('');

    const page = usePage<{
        company: Company;
        recent_property_searches?: RecentPropertySearch[];
        auth: {
            user: {
                id: number;
                name: string;
                email: string;
                avatar_url: string | null;
            } | null;
            unread_messages_count?: number;
        };
    }>();

    const { company, auth, recent_property_searches: recentSearches = [] } = page.props;
    const path = page.url.split('?')[0] ?? '';
    const user = auth?.user ?? null;
    const unread = auth?.unread_messages_count ?? 0;

    const brandName = company?.name ?? 'Account';

    const browseNav: {
        href: string;
        label: string;
        icon: typeof LayoutDashboard;
        match: (p: string) => boolean;
    }[] = [
        { href: '/pricing', label: 'Prices', icon: CircleDollarSign, match: (p) => p === '/pricing' },
        { href: '/properties', label: 'Properties', icon: Building2, match: (p) => p.startsWith('/properties') },
        {
            href: '/account#advanced-search',
            label: 'Advanced search',
            icon: SlidersHorizontal,
            match: (p) => p === '/account',
        },
    ];

    const accountNav: {
        href: string;
        label: string;
        icon: typeof LayoutDashboard;
        match: (p: string) => boolean;
        badge?: number;
    }[] = [
        { href: '/account', label: 'Dashboard', icon: LayoutDashboard, match: (p) => p === '/account' },
        {
            href: '/account/messages',
            label: 'Messages',
            icon: MessageCircle,
            match: (p) => p.startsWith('/account/messages'),
            badge: unread > 0 ? unread : undefined,
        },
        {
            href: '/account/profile',
            label: 'Profile',
            icon: UserCircle,
            match: (p) => p.startsWith('/account/profile'),
        },
    ];

    const closeMobileNav = () => setMobileNavOpen(false);

    const onHeaderSearch = (e: React.FormEvent) => {
        e.preventDefault();
        const q = headerKeyword.trim();
        router.visit(q ? `/properties?keyword=${encodeURIComponent(q)}` : '/properties');
        closeMobileNav();
    };

    const sidebarInner = (
        <>
            <div className="border-white/10 flex items-start gap-3 border-b px-4 py-5">
                {company?.logo ? (
                    <img src={company.logo} alt="" className="size-11 shrink-0 rounded-full border-2 border-white/25 object-cover" />
                ) : (
                    <div className="flex size-11 shrink-0 items-center justify-center rounded-full bg-white/15 text-lg font-bold text-white">
                        {brandName.slice(0, 1)}
                    </div>
                )}
                <div className="min-w-0 pt-0.5">
                    <p className="truncate text-base font-bold tracking-tight text-white">{brandName}</p>
                    <p className="text-xs font-medium text-white/65">Member panel</p>
                </div>
            </div>

            <nav className="flex flex-1 flex-col gap-4 overflow-y-auto px-3 py-4">
                <div>
                    <p className="text-[10px] font-semibold tracking-wider text-white/45 uppercase px-3 pb-2">Browse</p>
                    <div className="flex flex-col gap-1">
                        {browseNav.map((item) => {
                            const active = item.match(path);
                            const Icon = item.icon;

                            return (
                                <Link
                                    key={item.href}
                                    href={item.href}
                                    onClick={closeMobileNav}
                                    className={cn(
                                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors',
                                        active
                                            ? 'border-l-[3px] border-amber-400 bg-white/12 text-white'
                                            : 'border-l-[3px] border-transparent text-white/85 hover:bg-white/8',
                                    )}
                                >
                                    <Icon className={cn('size-5 shrink-0', active ? 'text-amber-300' : 'text-white/65')} aria-hidden />
                                    <span className="flex-1 truncate">{item.label}</span>
                                </Link>
                            );
                        })}
                    </div>
                </div>

                {recentSearches.length > 0 ? (
                    <div className="border-white/10 border-t pt-2">
                        <p className="text-[10px] font-semibold tracking-wider text-white/45 uppercase px-3 pb-2">
                            Latest searches
                        </p>
                        <div className="flex flex-col gap-0.5">
                            {recentSearches.map((row) => (
                                <Link
                                    key={row.id}
                                    href={propertiesUrlFromParams(row.params)}
                                    title={row.label}
                                    onClick={closeMobileNav}
                                    className="border-l-[3px] border-transparent px-3 py-2 text-[13px] leading-snug text-white/85 hover:bg-white/8 hover:text-white"
                                >
                                    <span className="line-clamp-2">{row.label}</span>
                                    <span className="mt-0.5 block text-[10px] font-medium text-white/45">
                                        Open listings · newest first
                                    </span>
                                </Link>
                            ))}
                        </div>
                    </div>
                ) : null}

                <div className="border-white/10 border-t pt-2">
                    <p className="text-[10px] font-semibold tracking-wider text-white/45 uppercase px-3 pb-2">Account</p>
                    <div className="flex flex-col gap-1">
                        {accountNav.map((item) => {
                            const active = item.match(path);
                            const Icon = item.icon;

                            return (
                                <Link
                                    key={item.href}
                                    href={item.href}
                                    onClick={closeMobileNav}
                                    className={cn(
                                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors',
                                        active
                                            ? 'border-l-[3px] border-amber-400 bg-white/12 text-white'
                                            : 'border-l-[3px] border-transparent text-white/85 hover:bg-white/8',
                                    )}
                                >
                                    <Icon className={cn('size-5 shrink-0', active ? 'text-amber-300' : 'text-white/65')} aria-hidden />
                                    <span className="flex-1 truncate">{item.label}</span>
                                    {item.badge != null ? (
                                        <span className="bg-amber-400/90 text-[#3647b7] flex h-5 min-w-5 items-center justify-center rounded-full px-1.5 text-[10px] font-bold tabular-nums">
                                            {item.badge > 99 ? '99+' : item.badge}
                                        </span>
                                    ) : null}
                                </Link>
                            );
                        })}
                    </div>
                </div>
            </nav>

            <div className="border-white/10 mt-auto border-t px-3 py-4">
                <Link
                    href="/"
                    onClick={closeMobileNav}
                    className="text-white/80 hover:bg-white/10 flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition-colors"
                >
                    <Globe className="size-4 shrink-0 opacity-80" aria-hidden />
                    Browse website
                </Link>
            </div>
        </>
    );

    return (
        <div className="flex min-h-screen w-full">
            {/* Mobile overlay */}
            {mobileNavOpen ? (
                <button
                    type="button"
                    aria-label="Close menu"
                    className="fixed inset-0 z-40 bg-black/45 lg:hidden"
                    onClick={closeMobileNav}
                />
            ) : null}

            {/* Sidebar */}
            <aside
                className={cn(
                    'fixed inset-y-0 left-0 z-50 flex w-[260px] flex-col shadow-xl transition-transform duration-200 lg:static lg:z-auto lg:translate-x-0 lg:shadow-none',
                    'bg-linear-to-b from-[#4657d4] via-[#3d4fc8] to-[#3647b7]',
                    mobileNavOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
                )}
            >
                <div className="flex items-center justify-end border-b border-white/10 px-2 py-2 lg:hidden">
                    <Button type="button" variant="ghost" size="icon" className="text-white hover:bg-white/15" onClick={closeMobileNav}>
                        <X className="size-5" />
                    </Button>
                </div>
                {sidebarInner}
            </aside>

            {/* Main column */}
            <div className="flex min-w-0 flex-1 flex-col">
                <header className="border-border bg-background sticky top-0 z-30 flex flex-wrap items-center gap-3 border-b px-4 py-3 shadow-sm dark:bg-zinc-900">
                    <Button
                        type="button"
                        variant="outline"
                        size="icon"
                        className="shrink-0 lg:hidden"
                        aria-label="Open menu"
                        onClick={() => setMobileNavOpen(true)}
                    >
                        <Menu className="size-5" />
                    </Button>

                    <form onSubmit={onHeaderSearch} className="flex min-w-0 max-w-xl flex-1 items-center gap-2">
                        <div className="relative flex-1">
                            <Search className="text-muted-foreground pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2" aria-hidden />
                            <Input
                                value={headerKeyword}
                                onChange={(e) => setHeaderKeyword(e.target.value)}
                                placeholder="Search properties..."
                                className="bg-muted/40 border-transparent pr-3 pl-10 dark:bg-zinc-800/80"
                                aria-label="Search properties"
                            />
                        </div>
                        <Button type="submit" size="sm" variant="secondary" className="shrink-0">
                            Search
                        </Button>
                    </form>

                    <div className="flex shrink-0 items-center gap-1 sm:gap-2">
                        <Button type="button" variant="outline" size="icon" aria-label="Toggle dark mode" onClick={toggleTheme}>
                            <Moon className="size-4 dark:hidden" />
                            <Sun className="hidden size-4 dark:inline" />
                        </Button>

                        <Link href="/account/messages">
                            <Button type="button" variant="outline" size="icon" className="relative" aria-label="Messages">
                                <MessageCircle className="size-4" />
                                {unread > 0 ? (
                                    <span className="absolute -top-1 -right-1 flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">
                                        {unread > 9 ? '9+' : unread}
                                    </span>
                                ) : null}
                            </Button>
                        </Link>

                        {user ? (
                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button
                                        variant="outline"
                                        size="icon"
                                        className="size-10 shrink-0 overflow-hidden rounded-full p-0"
                                        aria-label={`Open account menu (${user.name})`}
                                    >
                                        {user.avatar_url ? (
                                            <img src={user.avatar_url} alt="" className="size-10 border-0 object-cover" />
                                        ) : (
                                            <span className="bg-primary/15 text-primary flex size-10 items-center justify-center rounded-full text-xs font-semibold">
                                                {initialsFromName(user.name)}
                                            </span>
                                        )}
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end" className="w-56">
                                    <DropdownMenuLabel className="font-normal">
                                        <div className="flex flex-col gap-0.5">
                                            <span className="truncate font-medium">{user.name}</span>
                                            <span className="text-muted-foreground truncate text-xs">{user.email}</span>
                                            <span className="text-muted-foreground text-xs">Member</span>
                                        </div>
                                    </DropdownMenuLabel>
                                    <DropdownMenuSeparator />
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
                                </DropdownMenuContent>
                            </DropdownMenu>
                        ) : null}
                    </div>
                </header>

                <div className="bg-zinc-100 dark:bg-zinc-950 flex-1 overflow-y-auto p-4 md:p-6">{children}</div>
            </div>
        </div>
    );
}
