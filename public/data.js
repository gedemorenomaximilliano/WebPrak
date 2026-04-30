const packages = [
    {
        id: 1,
        name: "Paket A",
        destination: "Kawah Ijen",
        price: 500000,
        image: "Explore_KawahIjen.png",
        description: "Experience the magic of Ijen Crater with its famous blue fire and stunning acid lake.",
        itinerary: [
            "00.30 - Meeting Point",
            "01.00 - Depart to Paltuding",
            "02.00 - Start Trekking",
            "04.00 - Blue Fire & Sunrise"
        ],
        isPopular: true,
        availableFrom: "2026-05-01",
        availableUntil: "2026-05-31"
    },
    {
        id: 2,
        name: "Paket B",
        destination: "Pulau Merah",
        price: 500000,
        image: "Explore_PulauMerah.png",
        description: "Enjoy the beautiful sunset and red sand at the iconic Pulau Merah beach.",
        itinerary: [
            "14.00 - Meeting Point",
            "15.00 - Beach Exploration",
            "17.30 - Sunset Viewing",
            "19.00 - Dinner by the Beach"
        ],
        isPopular: true,
        availableFrom: "2026-06-01",
        availableUntil: "2026-06-30"
    },
    {
        id: 3,
        name: "Paket C",
        destination: "De Djawatan",
        price: 500000,
        image: "Explore_DeDjawatan.png",
        description: "Walk through the enchanted forest of De Djawatan with its giant trembesi trees.",
        itinerary: [
            "08.00 - Meeting Point",
            "09.00 - Forest Walk",
            "11.00 - Photo Session",
            "12.00 - Lunch"
        ],
        isPopular: true,
        availableFrom: "2026-07-01",
        availableUntil: "2026-07-31"
    },
    {
        id: 4,
        name: "Pulau Tabuhan",
        destination: "Pulau Tabuhan",
        price: 295000,
        image: "Explore_PulauMerah.png",
        description: "Snorkel in the crystal clear waters of the uninhabited Tabuhan Island.",
        itinerary: [
            "07.00 - Grand Watu Dodol",
            "08.00 - Crossing to Tabuhan",
            "09.00 - Snorkeling",
            "12.00 - Picnic Lunch"
        ],
        isPopular: true,
        availableFrom: "2026-08-01",
        availableUntil: "2026-08-31"
    }
];

const userTickets = [
    {
        id: "T-001",
        packageName: "Kawah Ijen Adventure",
        date: "15 May 2026",
        image: "Ijen_card.webp",
        status: "Active"
    },
    {
        id: "T-002",
        packageName: "Pulau Merah Sunset",
        date: "10 April 2026",
        image: "Explore_PulauMerah.png",
        status: "Used"
    }
];

const userTransactions = [
    {
        id: "TRX-9921",
        packageName: "Paket A - Kawah Ijen",
        date: "Apr 25, 2026",
        amount: 500000,
        status: "Success"
    },
    {
        id: "TRX-9845",
        packageName: "Paket B - Pulau Merah",
        date: "Apr 10, 2026",
        amount: 500000,
        status: "Success"
    },
    {
        id: "TRX-9712",
        packageName: "Paket C - De Djawatan",
        date: "Mar 28, 2026",
        amount: 500000,
        status: "Failed"
    }
];

const dashboardStats = {
    newOrders: 1250,
    revenues: "150M",
    pageViews: 45000,
    trafficOverview: 8200,
    ticketsSold: 3200,
    conversionRate: "12.5%"
};

window.appData = {
    packages,
    userTickets,
    userTransactions,
    dashboardStats,
    cart: [] 
};
console.log("data.js initialized:", window.appData);
