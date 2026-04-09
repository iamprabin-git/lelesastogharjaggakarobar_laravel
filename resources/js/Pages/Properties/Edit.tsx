import { Link, router, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { SiteLayout } from '@/layouts/site-layout';
import { cn } from '@/lib/utils';

type EditImage = { index: number; url: string };

type PropertyEdit = {
    id: number;
    title: string;
    description: string;
    price: number;
    type: string;
    availability: string;
    status: string;
    youtube_link: string;
    images: EditImage[];
};

type Props = {
    property: PropertyEdit;
};

const selectClass = cn(
    'border-input bg-background text-foreground mt-1 flex h-9 w-full rounded-md border px-3 text-sm shadow-xs',
    'outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50',
);

export default function Edit({ property }: Props) {
    const form = useForm({
        _method: 'put' as const,
        title: property.title,
        description: property.description,
        price: String(property.price),
        type: property.type,
        availability: property.availability,
        status: property.status,
        youtube_link: property.youtube_link,
        images: [] as File[],
    });

    const deleteImage = (index: number) => {
        if (!window.confirm('Remove this image?')) {
            return;
        }
        router.delete(`/properties/${property.id}/image/${index}`, {
            preserveScroll: true,
        });
    };

    return (
        <SiteLayout title="Edit listing">
            <div className="container mx-auto px-4 py-10">
                <div className="bg-card text-card-foreground mx-auto max-w-3xl rounded-xl border p-8 shadow-sm">
                    <h1 className="mb-2 text-2xl font-bold tracking-tight">Edit listing</h1>
                    <p className="text-muted-foreground mb-8 text-sm">Update your property details and save changes.</p>

                    {property.images.length > 0 ? (
                        <div className="mb-8">
                            <span className="text-foreground text-sm font-medium">Current photos</span>
                            <ul className="mt-3 grid gap-4 sm:grid-cols-2">
                                {property.images.map((img) => (
                                    <li
                                        key={img.index}
                                        className="border-input flex flex-col gap-2 overflow-hidden rounded-lg border p-2 text-sm"
                                    >
                                        <img src={img.url} alt="" className="aspect-video w-full rounded-md object-cover" />
                                        <button
                                            type="button"
                                            className="text-destructive hover:text-destructive/90 text-left text-xs font-medium underline-offset-4 hover:underline"
                                            onClick={() => deleteImage(img.index)}
                                        >
                                            Remove image
                                        </button>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    ) : null}

                    <form
                        className="space-y-6"
                        encType="multipart/form-data"
                        onSubmit={(e) => {
                            e.preventDefault();
                            form.post(`/properties/${property.id}`, {
                                forceFormData: true,
                                preserveScroll: true,
                                onSuccess: () => form.setData('images', []),
                            });
                        }}
                    >
                        <div>
                            <Label htmlFor="title">Title</Label>
                            <Input
                                id="title"
                                name="title"
                                value={form.data.title}
                                onChange={(e) => form.setData('title', e.target.value)}
                                className="mt-1"
                                required
                            />
                            {form.errors.title ? <p className="text-destructive mt-2 text-xs">{form.errors.title}</p> : null}
                        </div>

                        <div>
                            <Label htmlFor="description">Description</Label>
                            <Textarea
                                id="description"
                                name="description"
                                rows={5}
                                value={form.data.description}
                                onChange={(e) => form.setData('description', e.target.value)}
                                className="mt-1 min-h-[120px]"
                            />
                            {form.errors.description ? (
                                <p className="text-destructive mt-2 text-xs">{form.errors.description}</p>
                            ) : null}
                        </div>

                        <div>
                            <Label htmlFor="price">Price (Rs.)</Label>
                            <Input
                                id="price"
                                name="price"
                                type="number"
                                step="0.01"
                                value={form.data.price}
                                onChange={(e) => form.setData('price', e.target.value)}
                                className="mt-1"
                                required
                            />
                            {form.errors.price ? <p className="text-destructive mt-2 text-xs">{form.errors.price}</p> : null}
                        </div>

                        <div className="grid gap-6 sm:grid-cols-2">
                            <div>
                                <Label htmlFor="type">Type</Label>
                                <select
                                    id="type"
                                    name="type"
                                    value={form.data.type}
                                    onChange={(e) => form.setData('type', e.target.value)}
                                    className={selectClass}
                                    required
                                >
                                    <option value="sale">Sale</option>
                                    <option value="rent">Rent</option>
                                </select>
                                {form.errors.type ? <p className="text-destructive mt-2 text-xs">{form.errors.type}</p> : null}
                            </div>
                            <div>
                                <Label htmlFor="availability">Availability</Label>
                                <select
                                    id="availability"
                                    name="availability"
                                    value={form.data.availability}
                                    onChange={(e) => form.setData('availability', e.target.value)}
                                    className={selectClass}
                                    required
                                >
                                    <option value="available">Available</option>
                                    <option value="rented">Rented</option>
                                    <option value="sold">Sold</option>
                                </select>
                                {form.errors.availability ? (
                                    <p className="text-destructive mt-2 text-xs">{form.errors.availability}</p>
                                ) : null}
                            </div>
                        </div>

                        <div>
                            <Label htmlFor="status">Status</Label>
                            <select
                                id="status"
                                name="status"
                                value={form.data.status}
                                onChange={(e) => form.setData('status', e.target.value)}
                                className={selectClass}
                                required
                            >
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            {form.errors.status ? <p className="text-destructive mt-2 text-xs">{form.errors.status}</p> : null}
                        </div>

                        <div>
                            <Label htmlFor="youtube_link">YouTube link (optional)</Label>
                            <Input
                                id="youtube_link"
                                name="youtube_link"
                                type="url"
                                value={form.data.youtube_link}
                                onChange={(e) => form.setData('youtube_link', e.target.value)}
                                className="mt-1"
                            />
                            {form.errors.youtube_link ? (
                                <p className="text-destructive mt-2 text-xs">{form.errors.youtube_link}</p>
                            ) : null}
                        </div>

                        <div>
                            <Label htmlFor="images">Add images (optional)</Label>
                            <input
                                id="images"
                                name="images[]"
                                type="file"
                                accept="image/jpeg,image/png,image/jpg"
                                multiple
                                className="border-input bg-background text-foreground mt-1 block w-full cursor-pointer rounded-md border px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-primary file:px-3 file:py-1.5 file:text-sm file:text-primary-foreground"
                                onChange={(e) => form.setData('images', Array.from(e.target.files ?? []))}
                            />
                            {Object.keys(form.errors)
                                .filter((k) => k.startsWith('images.'))
                                .map((k) => (
                                    <p key={k} className="text-destructive mt-2 text-xs">
                                        {form.errors[k as keyof typeof form.errors]}
                                    </p>
                                ))}
                        </div>

                        <div className="flex flex-wrap gap-3">
                            <Button type="submit" disabled={form.processing}>
                                Save changes
                            </Button>
                            <Button variant="outline" asChild>
                                <Link href={`/properties/${property.id}`}>Cancel</Link>
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </SiteLayout>
    );
}
