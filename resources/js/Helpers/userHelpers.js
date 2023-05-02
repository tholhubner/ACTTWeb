const isAdmin = (roles) => {
    if (roles) {
        roles.forEach(role => {
            if (roles.name === "super-admin" || role.name === "admin") {
                return true
            } else {
                return false
            }
        });
    }

    return false
}

export { isAdmin }
