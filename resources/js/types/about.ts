export type AboutPayload = {
    hero_title: string;
    hero_description: string | null;
    hero_image: string | null;
    about_image: string | null;
    experience_years: string;
    properties_sold: number;
    happy_clients: number;
    mission: string | null;
    vision: string | null;
};

export type AboutServiceItem = {
    id: number;
    title: string;
    description: string;
    icon: string;
};

export type TeamMemberPublic = {
    id: number;
    name: string;
    position: string;
    bio: string | null;
    photo: string | null;
    facebook: string | null;
    whatsapp: string | null;
    instagram: string | null;
    tiktok: string | null;
    linkedin: string | null;
    email: string | null;
    phone: string | null;
};
