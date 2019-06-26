let breakpoints = {
    heights: {
        smallDevices: 136,
        mediumDevices: 226,
        largeDevices: 100
    },
    widths: {
        smallDevices: [100, 680],
        mediumDevices: [681, 992],
        largeDevices: [993]
    },
    isLargeDevice: () => {
        return window.innerWidth >= breakpoints.widths.largeDevices[0];
    }
};

export default breakpoints;