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
        return document.body.clientWidth >= 992;
    }
};

export default breakpoints;