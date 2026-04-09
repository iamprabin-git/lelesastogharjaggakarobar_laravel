import { Link } from '@inertiajs/react';
import { Bell, Crown, Eye, Heart, Home, Mail, Phone } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';

const statCards = [
    { label: 'Active listings', value: '100', icon: Home, iconClass: 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400' },
    { label: 'Total views', value: '8,420', icon: Eye, iconClass: 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' },
    { label: 'Pending inquiries', value: '7', icon: Mail, iconClass: 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400' },
    { label: 'Active subscription', value: 'Premium', icon: Crown, iconClass: 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400', valueClass: 'text-xl' },
];

export default function Dashboard() {
    return (
        <SiteLayout title="Dashboard">
            <div className="container mx-auto space-y-10 px-4 py-8 lg:py-10">
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    {statCards.map(({ label, value, icon: Icon, iconClass, valueClass }) => (
                        <Card key={label} className="transition-shadow hover:shadow-md">
                            <CardContent className="flex items-center justify-between gap-4 pt-6">
                                <div>
                                    <p className="text-muted-foreground text-sm">{label}</p>
                                    <p className={cn('mt-1 text-3xl font-bold tracking-tight', valueClass)}>{value}</p>
                                </div>
                                <div className={cn('rounded-lg p-4', iconClass)}>
                                    <Icon className="size-8" strokeWidth={1.75} />
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        href="/agent/login"
                        className="from-primary to-primary/80 flex flex-col items-center justify-center rounded-xl bg-linear-to-r p-8 text-center text-primary-foreground shadow-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl"
                    >
                        <Home className="mb-4 size-14 opacity-95" strokeWidth={1.25} />
                        <h3 className="text-2xl font-semibold">Add new property</h3>
                        <p className="mt-3 text-lg opacity-90">List your house, land or apartment today</p>
                    </a>

                    <Card className="flex flex-col items-center justify-center p-8 text-center transition-all hover:scale-[1.02] hover:shadow-2xl">
                        <Heart className="mb-4 size-14 text-red-500" strokeWidth={1.25} />
                        <h3 className="text-2xl font-semibold">My favorites</h3>
                        <p className="text-muted-foreground mt-3 text-lg">View your saved properties</p>
                    </Card>

                    <Card className="flex flex-col items-center justify-center p-8 text-center transition-all hover:scale-[1.02] hover:shadow-2xl">
                        <Bell className="mb-4 size-14 text-amber-500" strokeWidth={1.25} />
                        <h3 className="text-2xl font-semibold">Notifications</h3>
                        <p className="text-muted-foreground mt-3 text-lg">Check new messages and updates</p>
                    </Card>
                </div>

                <Card>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 border-b pb-4">
                        <CardTitle className="text-xl">Recent activity</CardTitle>
                        <Button variant="link" className="h-auto p-0 text-sm" asChild>
                            <span className="cursor-not-allowed opacity-60">View all</span>
                        </Button>
                    </CardHeader>
                    <div className="divide-y">
                        <div className="hover:bg-muted/50 px-6 py-5 transition-colors">
                            <div className="flex items-center justify-between gap-4">
                                <div>
                                    <p className="font-medium">New inquiry received</p>
                                    <p className="text-muted-foreground mt-1 text-sm">
                                        Someone asked about your property in Budhanilkantha
                                    </p>
                                </div>
                                <span className="text-muted-foreground shrink-0 text-xs whitespace-nowrap">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </Card>

                <Card className="text-center">
                    <CardHeader>
                        <CardTitle className="text-xl">Need help? Connect with us</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 gap-4 sm:grid-cols-4">
                            <a
                                href="https://wa.me/9779765726294?text=Hello%20Lele%20Sasto%20Ghar"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="flex flex-col items-center gap-3 rounded-xl bg-emerald-50 p-5 transition-colors hover:bg-emerald-100 dark:bg-emerald-950/30 dark:hover:bg-emerald-950/50"
                            >
                                <span className="text-4xl" aria-hidden>
                                    💬
                                </span>
                                <span className="font-medium text-emerald-800 dark:text-emerald-300">WhatsApp</span>
                            </a>
                            <a
                                href="https://m.me/yourpage"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="flex flex-col items-center gap-3 rounded-xl bg-blue-50 p-5 transition-colors hover:bg-blue-100 dark:bg-blue-950/30 dark:hover:bg-blue-950/50"
                            >
                                <span className="text-4xl" aria-hidden>
                                    💙
                                </span>
                                <span className="font-medium text-blue-800 dark:text-blue-300">Messenger</span>
                            </a>
                            <a
                                href="mailto:info.lelesastogharjaggakarobar@gmail.com"
                                className="flex flex-col items-center gap-3 rounded-xl bg-red-50 p-5 transition-colors hover:bg-red-100 dark:bg-red-950/30 dark:hover:bg-red-950/50"
                            >
                                <Mail className="size-10 text-red-500" strokeWidth={1.5} />
                                <span className="font-medium text-red-800 dark:text-red-300">Email us</span>
                            </a>
                            <a
                                href="tel:+9779800000000"
                                className="flex flex-col items-center gap-3 rounded-xl bg-violet-50 p-5 transition-colors hover:bg-violet-100 dark:bg-violet-950/30 dark:hover:bg-violet-950/50"
                            >
                                <Phone className="size-10 text-violet-600" strokeWidth={1.5} />
                                <span className="font-medium text-violet-800 dark:text-violet-300">Call now</span>
                            </a>
                        </div>
                        <Button variant="outline" className="mt-6" asChild>
                            <Link href="/contact">Contact page</Link>
                        </Button>
                    </CardContent>
                </Card>
            </div>
        </SiteLayout>
    );
}
