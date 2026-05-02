import { Link } from '@inertiajs/react';
import { AgentDirectoryGrid, type PublicAgent } from '@/components/agent-directory';
import { Button } from '@/components/ui/button';
import { SiteLayout } from '@/layouts/site-layout';

export default function AgentsIndex({ agents }: { agents: PublicAgent[] }) {
    return (
        <SiteLayout title="Agent list">
            <div className="container mx-auto px-3 py-8 sm:px-4 md:py-14">
                <div className="mb-6 max-w-2xl sm:mb-8">
                    <h1 className="break-words text-2xl font-bold tracking-tight sm:text-3xl md:text-4xl">Agent list</h1>
                    <p className="text-muted-foreground mt-2 text-sm leading-relaxed sm:text-base">
                        <span className="md:hidden">
                            Reach our agents below.{' '}
                            <span className="text-foreground/90 font-medium">Tap a card</span> to flip for phone and email,
                            or use <span className="text-foreground/90 font-medium">View listings</span> on the front of each
                            card.
                        </span>
                        <span className="hidden md:inline">
                            Reach our registered agents directly.{' '}
                            <span className="text-foreground/90 font-medium">Hover a card</span> (or focus it with the keyboard)
                            to flip for contact details. Use <span className="text-foreground/90 font-medium">View listings</span>{' '}
                            on the front or back of the card to open properties.
                        </span>
                    </p>
                    <p className="text-muted-foreground mt-2 text-sm sm:text-base">
                        Interested in joining?{' '}
                        <Link href="/agent-form" className="text-primary font-medium underline-offset-4 hover:underline">
                            Apply to become an agent
                        </Link>
                        .
                    </p>
                </div>

                {agents.length === 0 ? (
                    <div className="rounded-xl border bg-card p-6 text-center sm:p-10">
                        <p className="text-muted-foreground">No agents are listed yet. Check back soon.</p>
                        <Button asChild className="mt-6">
                            <Link href="/">Home</Link>
                        </Button>
                    </div>
                ) : (
                    <AgentDirectoryGrid agents={agents} />
                )}
            </div>
        </SiteLayout>
    );
}
