import { Link } from '@inertiajs/react';
import { AgentDirectoryGrid, type PublicAgent } from '@/components/agent-directory';
import { Button } from '@/components/ui/button';
import { SiteLayout } from '@/layouts/site-layout';

export default function AgentsIndex({ agents }: { agents: PublicAgent[] }) {
    return (
        <SiteLayout title="Agent list">
            <div className="container mx-auto px-4 py-10 md:py-14">
                <div className="mb-8 max-w-2xl">
                    <h1 className="text-3xl font-bold tracking-tight md:text-4xl">Agent list</h1>
                    <p className="text-muted-foreground mt-2">
                        Reach our registered agents directly.{' '}
                        <span className="text-foreground/90 font-medium">Hover a card</span> to flip and see contact
                        details; <span className="text-foreground/90 font-medium">click the card</span> (or press Enter
                        when focused) to open their property listings.
                    </p>
                    <p className="text-muted-foreground mt-2">
                        Interested in joining?{' '}
                        <Link href="/agent-form" className="text-primary font-medium underline-offset-4 hover:underline">
                            Apply to become an agent
                        </Link>
                        .
                    </p>
                </div>

                {agents.length === 0 ? (
                    <div className="rounded-xl border bg-card p-10 text-center">
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
