db.createUser(
    {
        user: "masajed",
        pwd: "masajed",
        roles: [
            {
                role: "readWrite",
                db: "masajed"
            }
        ]
    }
);
