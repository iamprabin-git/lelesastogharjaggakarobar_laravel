import * as React from 'react';
import { Link } from '@inertiajs/react';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';

function Pagination({ className, ...props }: React.ComponentProps<'nav'>) {
    return (
        <nav
            role="navigation"
            aria-label="pagination"
            data-slot="pagination"
            className={cn('mx-auto flex w-full justify-center', className)}
            {...props}
        />
    );
}

function PaginationContent({ className, ...props }: React.ComponentProps<'ul'>) {
    return <ul data-slot="pagination-content" className={cn('flex flex-row items-center gap-1', className)} {...props} />;
}

function PaginationItem({ className, ...props }: React.ComponentProps<'li'>) {
    return <li data-slot="pagination-item" className={cn('', className)} {...props} />;
}

type PaginationLinkProps = {
    href: string;
    active?: boolean;
    preserveScroll?: boolean;
    children: React.ReactNode;
    className?: string;
};

function PaginationLink({ href, active, preserveScroll = true, children, className }: PaginationLinkProps) {
    return (
        <Button variant={active ? 'default' : 'outline'} className={cn('h-9 min-w-9 px-3', className)} asChild>
            <Link href={href} preserveScroll={preserveScroll}>
                {children}
            </Link>
        </Button>
    );
}

function PaginationEllipsis({ className, ...props }: React.ComponentProps<'span'>) {
    return (
        <span
            aria-hidden
            data-slot="pagination-ellipsis"
            className={cn('text-muted-foreground flex size-9 items-center justify-center', className)}
            {...props}
        >
            …
        </span>
    );
}

export { Pagination, PaginationContent, PaginationEllipsis, PaginationItem, PaginationLink };
