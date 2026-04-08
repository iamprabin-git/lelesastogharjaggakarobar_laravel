export type PropertyCard = {
    id: number;
    title: string;
    price: number;
    type: string;
    availability: string;
    location: string | null;
    city: string | null;
    bedrooms: number | null;
    bathrooms: number | null;
    area: number | null;
    is_featured: boolean;
    image: string | null;
    agent: { name: string } | null;
};
