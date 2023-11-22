db.createUser(
    {
        user: "hadith",
        pwd: "hadith",
        roles: [
            {
                role: "readWrite",
                db: "hadith"
            }
        ]
    }
);
